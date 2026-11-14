<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\KbArticleData;
use Vented\Results\PaginatedResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class SupportKbResource
{
    public function __construct(private Vented $client) {}

    /**
     * Show a Knowledge Base article
     *
     * Operation: support.kb.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<KbArticleData>
     */
    public function find(string $article, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/support/kb/{article}')
            ->withPathParameters(['article' => $article])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): KbArticleData => KbArticleData::fromArray(self::attributes($resource, true)));
    }

    /**
     * List Knowledge Base articles
     *
     * Operation: support.kb.index
     *
     * @param  array<string, mixed>  $query
     * @return PaginatedResult<KbArticleData>
     */
    public function list(array $query = []): PaginatedResult
    {
        $operation = $this->client->operation('GET', '/support/kb')
            ->withQuery($query);

        return $operation->paginated(static fn (array $resource): KbArticleData => KbArticleData::fromArray(self::attributes($resource, true)));
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
