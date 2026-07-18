<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\ApiTokenData;
use Vented\Data\StoreApiTokenData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class ApiTokensResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create an API token
     *
     * Operation: account.api-tokens.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ApiTokenData>
     */
    public function create(StoreApiTokenData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/account/api-tokens')
            ->withBody([
                'data' => [
                    'type' => 'api_tokens',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ApiTokenData => ApiTokenData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Revoke an API token
     *
     * Operation: account.api-tokens.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $token, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/account/api-tokens/{token}')
            ->withPathParameters(['token' => $token])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * List your API tokens
     *
     * Operation: account.api-tokens.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<ApiTokenData>
     */
    public function list(array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/account/api-tokens')
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): ApiTokenData => ApiTokenData::fromArray(self::attributes($resource, true)));
    }

    /**
     * @param  array<string, mixed>  $resource
     * @return array<string, mixed>
     */
    private static function attributes(array $resource, bool $includeId): array
    {
        $attributes = $resource['attributes'] ?? null;

        if (! is_array($attributes) || array_is_list($attributes)) {
            throw new \UnexpectedValueException('The JSON:API resource attributes must be an object.');
        }

        if ($includeId) {
            $id = $resource['id'] ?? null;

            if (! is_string($id)) {
                throw new \UnexpectedValueException('The JSON:API resource id must be a string.');
            }

            $attributes['id'] = $id;
        }

        return $attributes;
    }
}
