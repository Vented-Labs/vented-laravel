<?php

declare(strict_types=1);

namespace Vented;

use Stringable;

final readonly class Resource
{
    public function __construct(
        private Vented $client,
        private string $path,
    ) {}

    /**
     * @param  array<string, mixed>  $query
     */
    public function index(array $query = []): Operation
    {
        return $this->client->operation('GET', $this->path)->withQuery($query);
    }

    public function show(string|int|float|Stringable $id): Operation
    {
        return $this->memberOperation('GET', $id);
    }

    /**
     * @param  array<string, mixed>  $body
     */
    public function create(array $body): Operation
    {
        return $this->client->operation('POST', $this->path)->withBody($body);
    }

    /**
     * @param  array<string, mixed>  $body
     */
    public function update(string|int|float|Stringable $id, array $body): Operation
    {
        return $this->memberOperation('PATCH', $id)->withBody($body);
    }

    /**
     * @param  array<string, mixed>  $body
     */
    public function replace(string|int|float|Stringable $id, array $body): Operation
    {
        return $this->memberOperation('PUT', $id)->withBody($body);
    }

    public function delete(string|int|float|Stringable $id): Operation
    {
        return $this->memberOperation('DELETE', $id);
    }

    private function memberOperation(string $method, string|int|float|Stringable $id): Operation
    {
        return $this->client
            ->operation($method, rtrim($this->path, '/').'/{id}')
            ->withPathParameters(['id' => $id]);
    }
}
