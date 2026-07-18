<?php

declare(strict_types=1);

namespace Vented;

use Illuminate\Http\Client\Response;
use Stringable;
use Vented\Exceptions\InvalidResponseException;
use Vented\Results\BinaryResult;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\PaginatedResult;
use Vented\Results\ResourceResult;

final readonly class Operation
{
    /**
     * @param  array<string, scalar|Stringable>  $pathParameters
     * @param  array<string, mixed>  $query
     * @param  array<string, mixed>|OptionalValue  $body
     * @param  array<string, string>  $headers
     */
    public function __construct(
        private Transport $transport,
        private string $method,
        private string $path,
        private array $pathParameters = [],
        private array $query = [],
        private array|OptionalValue $body = OptionalValue::Missing,
        private array $headers = [],
    ) {}

    /**
     * @param  array<string, scalar|Stringable>  $parameters
     */
    public function withPathParameters(array $parameters): self
    {
        return new self(
            $this->transport,
            $this->method,
            $this->path,
            $parameters,
            $this->query,
            $this->body,
            $this->headers,
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function withQuery(array $query): self
    {
        return new self(
            $this->transport,
            $this->method,
            $this->path,
            $this->pathParameters,
            $query,
            $this->body,
            $this->headers,
        );
    }

    /**
     * @param  array<string, mixed>  $body
     */
    public function withBody(array $body): self
    {
        return new self(
            $this->transport,
            $this->method,
            $this->path,
            $this->pathParameters,
            $this->query,
            $body,
            $this->headers,
        );
    }

    /**
     * @param  array<string, string>  $headers
     */
    public function withHeaders(array $headers): self
    {
        return new self(
            $this->transport,
            $this->method,
            $this->path,
            $this->pathParameters,
            $this->query,
            $this->body,
            [...$this->headers, ...$headers],
        );
    }

    public function send(): Response
    {
        return $this->transport->send(
            $this->method,
            $this->path,
            $this->pathParameters,
            $this->query,
            $this->body,
            $this->headers,
        );
    }

    /**
     * @template TResource
     *
     * @param  callable(array<string, mixed>): TResource  $hydrate
     * @return ResourceResult<TResource>
     */
    public function resource(callable $hydrate): ResourceResult
    {
        $response = $this->send();
        $document = $this->document($response);
        $data = $document['data'] ?? null;

        if (! is_array($data) || array_is_list($data)) {
            throw new InvalidResponseException('The Vented API response did not contain a JSON:API resource object.', $response);
        }

        return new ResourceResult(
            data: $hydrate($data),
            response: $response,
            meta: $this->member($document, 'meta'),
            links: $this->member($document, 'links'),
        );
    }

    /**
     * @template TResource
     *
     * @param  callable(array<string, mixed>): TResource  $hydrate
     * @return CollectionResult<TResource>
     */
    public function collection(callable $hydrate): CollectionResult
    {
        $response = $this->send();
        $document = $this->document($response);

        return new CollectionResult(
            data: $this->hydrateCollection($document, $response, $hydrate),
            response: $response,
            meta: $this->member($document, 'meta'),
            links: $this->member($document, 'links'),
        );
    }

    /**
     * @template TResource
     *
     * @param  callable(array<string, mixed>): TResource  $hydrate
     * @return PaginatedResult<TResource>
     */
    public function paginated(callable $hydrate): PaginatedResult
    {
        $response = $this->send();
        $document = $this->document($response);

        return new PaginatedResult(
            data: $this->hydrateCollection($document, $response, $hydrate),
            response: $response,
            meta: $this->member($document, 'meta'),
            links: $this->member($document, 'links'),
        );
    }

    public function noContent(): NoContentResult
    {
        return new NoContentResult($this->send());
    }

    public function binary(): BinaryResult
    {
        $response = $this->send();

        return new BinaryResult(
            body: $response->body(),
            response: $response,
            contentType: $response->header('Content-Type'),
        );
    }

    /**
     * @return array<string, mixed>
     */
    private function document(Response $response): array
    {
        $document = $response->json();

        if (! is_array($document) || array_is_list($document)) {
            throw new InvalidResponseException('The Vented API response was not a JSON:API document.', $response);
        }

        return $document;
    }

    /**
     * @template TResource
     *
     * @param  array<string, mixed>  $document
     * @param  callable(array<string, mixed>): TResource  $hydrate
     * @return list<TResource>
     */
    private function hydrateCollection(array $document, Response $response, callable $hydrate): array
    {
        $data = $document['data'] ?? null;

        if (! is_array($data) || ! array_is_list($data)) {
            throw new InvalidResponseException('The Vented API response did not contain a JSON:API resource collection.', $response);
        }

        $resources = [];

        foreach ($data as $resource) {
            if (! is_array($resource) || array_is_list($resource)) {
                throw new InvalidResponseException('The Vented API response contained an invalid JSON:API resource object.', $response);
            }

            $resources[] = $hydrate($resource);
        }

        return $resources;
    }

    /**
     * @param  array<string, mixed>  $document
     * @return array<string, mixed>
     */
    private function member(array $document, string $key): array
    {
        $value = $document[$key] ?? null;

        return is_array($value) ? $value : [];
    }
}
