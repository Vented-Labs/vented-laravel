<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\SupportTicketType;

final readonly class StoreTicketData
{
    public function __construct(
        public bool $allow_support_access,
        public string $description,
        public ?string $project_id,
        public string $subject,
        public SupportTicketType $ticket_type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            allow_support_access: (bool) $data['allow_support_access'],
            description: (string) $data['description'],
            project_id: $data['project_id'] === null ? null : (string) $data['project_id'],
            subject: (string) $data['subject'],
            ticket_type: SupportTicketType::from((string) $data['ticket_type']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['allow_support_access'] = $this->allow_support_access;
        $data['description'] = $this->description;
        $data['project_id'] = $this->project_id === null ? null : $this->project_id;
        $data['subject'] = $this->subject;
        $data['ticket_type'] = $this->ticket_type->value;

        return $data;
    }
}
