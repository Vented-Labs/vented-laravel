<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SettingsShowMetaCapabilities
{
    public function __construct(
        public bool $can_delete,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_delete: (bool) $data['can_delete'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_delete'] = $this->can_delete;

        return $data;
    }
}
