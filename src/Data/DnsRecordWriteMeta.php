<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class DnsRecordWriteMeta
{
    /**
     * @param  list<string>  $warnings
     */
    public function __construct(
        public array $warnings,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            warnings: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['warnings'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['warnings'] = $this->warnings;

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
