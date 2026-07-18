<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class DnsRecordSchema
{
    /**
     * @param  list<DnsRecordSchemaField>  $fields
     */
    public function __construct(
        public array $fields,
        public string $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            fields: array_map(static fn (mixed $value): DnsRecordSchemaField => DnsRecordSchemaField::fromArray(self::objectValue($value)), self::listValue($data['fields'])),
            type: (string) $data['type'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['fields'] = array_map(static fn (DnsRecordSchemaField $value) => $value->toArray(), $this->fields);
        $data['type'] = $this->type;

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    private static function objectValue(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \InvalidArgumentException('Expected an object value.');
        }

        /** @var array<string, mixed> $value */
        return $value;
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
