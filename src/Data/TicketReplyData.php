<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class TicketReplyData
{
    public function __construct(
        public string $body,
        public string $body_html,
        public bool $can_delete,
        public bool $can_edit,
        public string $created_at,
        public string $id,
        public string $support_ticket_id,
        public string $updated_at,
        public string $user_id,
        public ?string $user_name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            body: (string) $data['body'],
            body_html: (string) $data['body_html'],
            can_delete: (bool) $data['can_delete'],
            can_edit: (bool) $data['can_edit'],
            created_at: (string) $data['created_at'],
            id: (string) $data['id'],
            support_ticket_id: (string) $data['support_ticket_id'],
            updated_at: (string) $data['updated_at'],
            user_id: (string) $data['user_id'],
            user_name: $data['user_name'] === null ? null : (string) $data['user_name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['body'] = $this->body;
        $data['body_html'] = $this->body_html;
        $data['can_delete'] = $this->can_delete;
        $data['can_edit'] = $this->can_edit;
        $data['created_at'] = $this->created_at;
        $data['id'] = $this->id;
        $data['support_ticket_id'] = $this->support_ticket_id;
        $data['updated_at'] = $this->updated_at;
        $data['user_id'] = $this->user_id;
        $data['user_name'] = $this->user_name === null ? null : $this->user_name;

        return $data;
    }
}
