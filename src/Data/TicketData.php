<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\SupportTicketType;

final readonly class TicketData
{
    /**
     * @param  list<TicketReplyData>  $replies
     */
    public function __construct(
        public bool $can_manage_support_access,
        public bool $can_reply,
        public ?string $created_at,
        public string $description,
        public string $description_html,
        public string $id,
        public ?string $project_id,
        public array $replies,
        public ?StatusData $status,
        public string $subject,
        public ?string $support_access_expires_at,
        public bool $support_access_granted,
        public ?SupportTicketType $ticket_type,
        public ?string $updated_at,
        public ?string $user_id,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_manage_support_access: (bool) $data['can_manage_support_access'],
            can_reply: (bool) $data['can_reply'],
            created_at: $data['created_at'] === null ? null : (string) $data['created_at'],
            description: (string) $data['description'],
            description_html: (string) $data['description_html'],
            id: (string) $data['id'],
            project_id: $data['project_id'] === null ? null : (string) $data['project_id'],
            replies: array_map(static fn (mixed $value): TicketReplyData => TicketReplyData::fromArray(self::objectValue($value)), self::listValue($data['replies'])),
            status: $data['status'] === null ? null : StatusData::fromArray(self::objectValue($data['status'])),
            subject: (string) $data['subject'],
            support_access_expires_at: $data['support_access_expires_at'] === null ? null : (string) $data['support_access_expires_at'],
            support_access_granted: (bool) $data['support_access_granted'],
            ticket_type: $data['ticket_type'] === null ? null : SupportTicketType::from((string) $data['ticket_type']),
            updated_at: $data['updated_at'] === null ? null : (string) $data['updated_at'],
            user_id: $data['user_id'] === null ? null : (string) $data['user_id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_manage_support_access'] = $this->can_manage_support_access;
        $data['can_reply'] = $this->can_reply;
        $data['created_at'] = $this->created_at === null ? null : $this->created_at;
        $data['description'] = $this->description;
        $data['description_html'] = $this->description_html;
        $data['id'] = $this->id;
        $data['project_id'] = $this->project_id === null ? null : $this->project_id;
        $data['replies'] = array_map(static fn (TicketReplyData $value) => $value->toArray(), $this->replies);
        $data['status'] = $this->status === null ? null : $this->status->toArray();
        $data['subject'] = $this->subject;
        $data['support_access_expires_at'] = $this->support_access_expires_at === null ? null : $this->support_access_expires_at;
        $data['support_access_granted'] = $this->support_access_granted;
        $data['ticket_type'] = $this->ticket_type === null ? null : $this->ticket_type->value;
        $data['updated_at'] = $this->updated_at === null ? null : $this->updated_at;
        $data['user_id'] = $this->user_id === null ? null : $this->user_id;

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    private static function objectValue(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \InvalidArgumentException('Expected an object value.');
        }

        /** @var array<string, mixed> $value */
        return $value;
    }

    /**
     * @return list<mixed>
     */
    private static function listValue(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \InvalidArgumentException('Expected an array value.');
        }

        return array_values($value);
    }
}
