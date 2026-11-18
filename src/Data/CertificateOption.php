<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class CertificateOption
{
    /**
     * @param  list<string>  $names
     */
    public function __construct(
        public ?string $expiry_notice,
        public string $id,
        public string $name,
        public array $names,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            expiry_notice: $data['expiry_notice'] === null ? null : (string) $data['expiry_notice'],
            id: (string) $data['id'],
            name: (string) $data['name'],
            names: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['names'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['expiry_notice'] = $this->expiry_notice === null ? null : $this->expiry_notice;
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['names'] = $this->names;

        return $data;
    }

    /**
     * @return list<mixed>
     */
    private static function listValue(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \InvalidArgumentException('Expected an array value.');
        }

        return array_values($value);
    }
}
