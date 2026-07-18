<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class DnsZonesShowMeta
{
    /**
     * @param  list<DnsZoneRequiredRecord>  $required_records
     */
    public function __construct(
        public DnsZonesIndexMetaFormOptions $form_options,
        public array $required_records,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            form_options: DnsZonesIndexMetaFormOptions::fromArray(self::objectValue($data['form_options'])),
            required_records: array_map(static fn (mixed $value): DnsZoneRequiredRecord => DnsZoneRequiredRecord::fromArray(self::objectValue($value)), self::listValue($data['required_records'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['form_options'] = $this->form_options->toArray();
        $data['required_records'] = array_map(static fn (DnsZoneRequiredRecord $value) => $value->toArray(), $this->required_records);

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
