<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\StoreReplyData;
use Vented\Data\TicketReplyData;
use Vented\Data\UpdateReplyData;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class SupportTicketRepliesResource
{
    public function __construct(private Vented $client) {}

    /**
     * Add a reply to a ticket
     *
     * Operation: support.tickets.replies.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<TicketReplyData>
     */
    public function create(string $ticket, StoreReplyData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/support/tickets/{ticket}/replies')
            ->withPathParameters(['ticket' => $ticket])
            ->withBody([
                'data' => [
                    'type' => 'ticket_replies',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): TicketReplyData => TicketReplyData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Delete a reply
     *
     * Operation: support.tickets.replies.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $ticket, string $reply, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/support/tickets/{ticket}/replies/{reply}')
            ->withPathParameters(['ticket' => $ticket, 'reply' => $reply])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Edit a reply
     *
     * Operation: support.tickets.replies.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<TicketReplyData>
     */
    public function update(string $ticket, string $reply, UpdateReplyData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/support/tickets/{ticket}/replies/{reply}')
            ->withPathParameters(['ticket' => $ticket, 'reply' => $reply])
            ->withBody([
                'data' => [
                    'type' => 'ticket_replies',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): TicketReplyData => TicketReplyData::fromArray(self::attributes($resource, true)));
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
