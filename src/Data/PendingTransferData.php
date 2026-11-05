<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class PendingTransferData
{
    public function __construct(
        public string $email,
        public string $expires_at,
        public string $member_id,
        public string $name,
        public string $offered_at,
        public string $offered_by_name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            email: (string) $data['email'],
            expires_at: (string) $data['expires_at'],
            member_id: (string) $data['member_id'],
            name: (string) $data['name'],
            offered_at: (string) $data['offered_at'],
            offered_by_name: (string) $data['offered_by_name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['email'] = $this->email;
        $data['expires_at'] = $this->expires_at;
        $data['member_id'] = $this->member_id;
        $data['name'] = $this->name;
        $data['offered_at'] = $this->offered_at;
        $data['offered_by_name'] = $this->offered_by_name;

        return $data;
    }
}
