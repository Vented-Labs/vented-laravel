<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ServiceBackupsMetaService
{
    public function __construct(
        public string $name,
        public string $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: (string) $data['name'],
            type: (string) $data['type'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['name'] = $this->name;
        $data['type'] = $this->type;

        return $data;
    }
}
