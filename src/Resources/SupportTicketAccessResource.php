<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\TicketData;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class SupportTicketAccessResource
{
    public function __construct(private Vented $client) {}

    /**
     * Allow support access for a ticket
     *
     * Operation: support.tickets.access.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<TicketData>
     */
    public function create(string $ticket, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/support/tickets/{ticket}/access')
            ->withPathParameters(['ticket' => $ticket])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): TicketData => TicketData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Stop support access for a ticket
     *
     * Operation: support.tickets.access.destroy
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<TicketData>
     */
    public function delete(string $ticket, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('DELETE', '/support/tickets/{ticket}/access')
            ->withPathParameters(['ticket' => $ticket])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): TicketData => TicketData::fromArray(self::attributes($resource, true)));
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
