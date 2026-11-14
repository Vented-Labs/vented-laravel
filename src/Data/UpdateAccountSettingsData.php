<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class UpdateAccountSettingsData
{
    public function __construct(
        public string $email,
        public string $name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            email: (string) $data['email'],
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
        $data['name'] = $this->name;

        return $data;
    }
}
