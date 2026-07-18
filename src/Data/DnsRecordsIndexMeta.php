<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class DnsRecordsIndexMeta
{
    /**
     * @param  list<DnsEditorRequiredRecord>  $editor_required_records
     * @param  array<string, mixed>  $records
     */
    public function __construct(
        public array $editor_required_records,
        public DnsRecordsIndexMetaFormOptions $form_options,
        public array $records,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            editor_required_records: array_map(static fn (mixed $value): DnsEditorRequiredRecord => DnsEditorRequiredRecord::fromArray(self::objectValue($value)), self::listValue($data['editor_required_records'])),
            form_options: DnsRecordsIndexMetaFormOptions::fromArray(self::objectValue($data['form_options'])),
            records: self::objectValue($data['records']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['editor_required_records'] = array_map(static fn (DnsEditorRequiredRecord $value) => $value->toArray(), $this->editor_required_records);
        $data['form_options'] = $this->form_options->toArray();
        $data['records'] = $this->records;

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
