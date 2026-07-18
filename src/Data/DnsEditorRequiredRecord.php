<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class DnsEditorRequiredRecord
{
    public function __construct(
        public DnsEditorRequiredRecordDetails $details,
        public string $id,
        public string $name,
        public bool $required,
        public string $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            details: DnsEditorRequiredRecordDetails::fromArray(self::objectValue($data['details'])),
            id: (string) $data['id'],
            name: (string) $data['name'],
            required: (bool) $data['required'],
            type: (string) $data['type'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['details'] = $this->details->toArray();
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['required'] = $this->required;
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
}
