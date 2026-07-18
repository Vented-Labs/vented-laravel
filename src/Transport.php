<?php

declare(strict_types=1);

namespace Vented;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use InvalidArgumentException;
use Stringable;
use Throwable;
use Vented\Exceptions\ApiException;
use Vented\Exceptions\MissingApiKeyException;
use Vented\Exceptions\TransportException;

final readonly class Transport
{
    /** @var array<string, true> */
    private const IDEMPOTENT_METHODS = ['DELETE' => true, 'GET' => true, 'PUT' => true];

    /** @var array<int, true> */
    private const RETRYABLE_STATUSES = [408 => true, 425 => true, 429 => true, 500 => true, 502 => true, 503 => true, 504 => true];

    /** @var array<string, true> */
    private const SUPPORTED_METHODS = ['DELETE' => true, 'GET' => true, 'PATCH' => true, 'POST' => true, 'PUT' => true];

    public function __construct(
        private Factory $http,
        private ClientConfiguration $configuration,
    ) {}

    /**
     * @param  array<string, scalar|Stringable>  $pathParameters
     * @param  array<string, mixed>  $query
     * @param  array<string, string>  $headers
     */
    public function get(string $path, array $pathParameters = [], array $query = [], array $headers = []): Response
    {
        return $this->send('GET', $path, $pathParameters, $query, OptionalValue::Missing, $headers);
    }

    /**
     * @param  array<string, mixed>  $body
     * @param  array<string, scalar|Stringable>  $pathParameters
     * @param  array<string, mixed>  $query
     * @param  array<string, string>  $headers
     */
    public function post(string $path, array $body, array $pathParameters = [], array $query = [], array $headers = []): Response
    {
        return $this->send('POST', $path, $pathParameters, $query, $body, $headers);
    }

    /**
     * @param  array<string, mixed>  $body
     * @param  array<string, scalar|Stringable>  $pathParameters
     * @param  array<string, mixed>  $query
     * @param  array<string, string>  $headers
     */
    public function patch(string $path, array $body, array $pathParameters = [], array $query = [], array $headers = []): Response
    {
        return $this->send('PATCH', $path, $pathParameters, $query, $body, $headers);
    }

    /**
     * @param  array<string, mixed>  $body
     * @param  array<string, scalar|Stringable>  $pathParameters
     * @param  array<string, mixed>  $query
     * @param  array<string, string>  $headers
     */
    public function put(string $path, array $body, array $pathParameters = [], array $query = [], array $headers = []): Response
    {
        return $this->send('PUT', $path, $pathParameters, $query, $body, $headers);
    }

    /**
     * @param  array<string, scalar|Stringable>  $pathParameters
     * @param  array<string, mixed>  $query
     * @param  array<string, mixed>|OptionalValue  $body
     * @param  array<string, string>  $headers
     */
    public function delete(
        string $path,
        array $pathParameters = [],
        array $query = [],
        array|OptionalValue $body = OptionalValue::Missing,
        array $headers = [],
    ): Response {
        return $this->send('DELETE', $path, $pathParameters, $query, $body, $headers);
    }

    /**
     * @param  array<string, scalar|Stringable>  $pathParameters
     * @param  array<string, mixed>  $query
     * @param  array<string, mixed>|OptionalValue  $body
     * @param  array<string, string>  $headers
     */
    public function send(
        string $method,
        string $path,
        array $pathParameters = [],
        array $query = [],
        array|OptionalValue $body = OptionalValue::Missing,
        array $headers = [],
    ): Response {
        $method = strtoupper($method);

        if (! isset(self::SUPPORTED_METHODS[$method])) {
            throw new InvalidArgumentException("Unsupported Vented HTTP method [{$method}].");
        }

        $request = $this->freshRequest($method, $headers);
        $url = $this->configuration->baseUrl.'/'.ltrim($this->encodePath($path, $pathParameters), '/');
        $options = [];

        if ($query !== []) {
            $options['query'] = $query;
        }

        if ($body !== OptionalValue::Missing) {
            $options['json'] = $body;
        }

        try {
            $response = $request->send($method, $url, $options);
        } catch (ConnectionException $exception) {
            throw new TransportException($exception);
        } catch (RequestException $exception) {
            throw ApiException::fromResponse($exception->response);
        }

        if (! $response->successful()) {
            throw ApiException::fromResponse($response);
        }

        return $response;
    }

    /**
     * @param  array<string, string>  $headers
     */
    private function freshRequest(string $method, array $headers): PendingRequest
    {
        $apiKey = $this->configuration->apiKey;

        if ($apiKey === null) {
            throw new MissingApiKeyException;
        }

        $request = $this->http
            ->createPendingRequest()
            ->withToken($apiKey)
            ->withHeaders([
                'Accept' => 'application/vnd.api+json',
                'Content-Type' => 'application/vnd.api+json',
                'User-Agent' => 'vented-laravel/'.PackageVersion::current(),
                ...$headers,
            ])
            ->timeout($this->configuration->timeout)
            ->connectTimeout($this->configuration->connectTimeout);

        if (isset(self::IDEMPOTENT_METHODS[$method]) && $this->configuration->retryTimes > 0) {
            $request->retry(
                $this->configuration->retryTimes + 1,
                $this->configuration->retryDelayMilliseconds,
                static function (Throwable $exception, PendingRequest $_request, ?string $_key): bool {
                    if ($exception instanceof ConnectionException) {
                        return true;
                    }

                    return $exception instanceof RequestException
                        && isset(self::RETRYABLE_STATUSES[$exception->response->status()]);
                },
                false,
            );
        }

        return $request;
    }

    /**
     * @param  array<string, scalar|Stringable>  $parameters
     */
    private function encodePath(string $path, array $parameters): string
    {
        $encoded = preg_replace_callback('/\{([A-Za-z_][A-Za-z0-9_]*)\}/', function (array $matches) use ($parameters): string {
            $name = $matches[1];

            if (! array_key_exists($name, $parameters)) {
                throw new InvalidArgumentException("Missing Vented path parameter [{$name}].");
            }

            $value = $parameters[$name];

            if (is_bool($value)) {
                return $value ? 'true' : 'false';
            }

            return rawurlencode((string) $value);
        }, $path);

        if ($encoded === null) {
            throw new InvalidArgumentException('The Vented request path could not be encoded.');
        }

        return $encoded;
    }
}
