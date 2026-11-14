<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\StoreTicketData;
use Vented\Data\TicketData;
use Vented\Results\PaginatedResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class SupportTicketsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Open a support ticket
     *
     * Operation: support.tickets.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<TicketData>
     */
    public function create(StoreTicketData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/support/tickets')
            ->withBody([
                'data' => [
                    'type' => 'tickets',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): TicketData => TicketData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Show a support ticket with its full reply thread
     *
     * Operation: support.tickets.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<TicketData>
     */
    public function find(string $ticket, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/support/tickets/{ticket}')
            ->withPathParameters(['ticket' => $ticket])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): TicketData => TicketData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Show the create-ticket scaffolding
     *
     * Operation: support.tickets.create
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<TicketData>
     */
    public function formOptions(array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/support/tickets/create')
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): TicketData => TicketData::fromArray(self::attributes($resource, true)));
    }

    /**
     * List your support tickets
     *
     * Operation: support.tickets.index
     *
     * @param  array<string, mixed>  $query
     * @return PaginatedResult<TicketData>
     */
    public function list(array $query = []): PaginatedResult
    {
        $operation = $this->client->operation('GET', '/support/tickets')
            ->withQuery($query);

        return $operation->paginated(static fn (array $resource): TicketData => TicketData::fromArray(self::attributes($resource, true)));
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
