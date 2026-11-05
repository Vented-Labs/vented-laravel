<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class TransferableMember
{
    public function __construct(
        public string $email,
        public string $id,
        public string $name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            email: (string) $data['email'],
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
        $data['email'] = $this->email;
        $data['id'] = $this->id;
        $data['name'] = $this->name;

        return $data;
    }
}
