<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AccountTwoFactorMetaPasskey
{
    public function __construct(
        public ?string $created_at,
        public string $id,
        public string $name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            created_at: $data['created_at'] === null ? null : (string) $data['created_at'],
            id: (string) $data['id'],
            name: (string) $data['name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['created_at'] = $this->created_at === null ? null : $this->created_at;
        $data['id'] = $this->id;
        $data['name'] = $this->name;

        return $data;
    }
}
