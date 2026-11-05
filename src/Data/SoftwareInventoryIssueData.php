<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\StatusTone;

final readonly class SoftwareInventoryIssueData
{
    public function __construct(
        public string $description,
        public string $id,
        public ?string $resource_key,
        public ?string $stack_id,
        public string $title,
        public StatusTone $tone,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            description: (string) $data['description'],
            id: (string) $data['id'],
            resource_key: $data['resource_key'] === null ? null : (string) $data['resource_key'],
            stack_id: $data['stack_id'] === null ? null : (string) $data['stack_id'],
            title: (string) $data['title'],
            tone: StatusTone::from((string) $data['tone']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['description'] = $this->description;
        $data['id'] = $this->id;
        $data['resource_key'] = $this->resource_key === null ? null : $this->resource_key;
        $data['stack_id'] = $this->stack_id === null ? null : $this->stack_id;
        $data['title'] = $this->title;
        $data['tone'] = $this->tone->value;

        return $data;
    }
}
