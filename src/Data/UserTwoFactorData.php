<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class UserTwoFactorData
{
    public function __construct(
        public string $id,
        public bool $two_factor_enabled,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) $data['id'],
            two_factor_enabled: (bool) $data['two_factor_enabled'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = $this->id;
        $data['two_factor_enabled'] = $this->two_factor_enabled;

        return $data;
    }
}
