<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ApprovalDeviceData
{
    public function __construct(
        public ?string $confirm_url,
        public bool $confirmed,
        public ?string $confirmed_at,
        public string $enrolled_at,
        public string $id,
        public ?string $last_used_at,
        public string $name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            confirm_url: $data['confirm_url'] === null ? null : (string) $data['confirm_url'],
            confirmed: (bool) $data['confirmed'],
            confirmed_at: $data['confirmed_at'] === null ? null : (string) $data['confirmed_at'],
            enrolled_at: (string) $data['enrolled_at'],
            id: (string) $data['id'],
            last_used_at: $data['last_used_at'] === null ? null : (string) $data['last_used_at'],
            name: (string) $data['name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['confirm_url'] = $this->confirm_url === null ? null : $this->confirm_url;
        $data['confirmed'] = $this->confirmed;
        $data['confirmed_at'] = $this->confirmed_at === null ? null : $this->confirmed_at;
        $data['enrolled_at'] = $this->enrolled_at;
        $data['id'] = $this->id;
        $data['last_used_at'] = $this->last_used_at === null ? null : $this->last_used_at;
        $data['name'] = $this->name;

        return $data;
    }
}
