<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\AiAgentConnectionData;
use Vented\Results\CollectionResult;
use Vented\Vented;

final readonly class AiAgentsResource
{
    public function __construct(private Vented $client) {}

    /**
     * List your connected AI agents
     *
     * Operation: account.ai-agents.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<AiAgentConnectionData>
     */
    public function list(array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/account/ai-agents')
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): AiAgentConnectionData => AiAgentConnectionData::fromArray(self::attributes($resource, true)));
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
