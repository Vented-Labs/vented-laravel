<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ServiceOutputData
{
    public function __construct(
        public string $name,
        public bool $sensitive,
        public string $value,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: (string) $data['name'],
            sensitive: (bool) $data['sensitive'],
            value: (string) $data['value'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['name'] = $this->name;
        $data['sensitive'] = $this->sensitive;
        $data['value'] = $this->value;

        return $data;
    }
}
