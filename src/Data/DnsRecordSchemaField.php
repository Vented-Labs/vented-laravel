<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class DnsRecordSchemaField
{
    /**
     * @param  list<DnsRecordSchemaFieldOption>  $options
     */
    public function __construct(
        public ?string $default,
        public ?string $help,
        public bool $hostname,
        public string $label,
        public bool $lowercase,
        public ?int $max,
        public ?int $max_length,
        public ?int $min,
        public string $name,
        public array $options,
        public ?string $placeholder,
        public bool $required,
        public string $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            default: $data['default'] === null ? null : (string) $data['default'],
            help: $data['help'] === null ? null : (string) $data['help'],
            hostname: (bool) $data['hostname'],
            label: (string) $data['label'],
            lowercase: (bool) $data['lowercase'],
            max: $data['max'] === null ? null : (int) $data['max'],
            max_length: $data['max_length'] === null ? null : (int) $data['max_length'],
            min: $data['min'] === null ? null : (int) $data['min'],
            name: (string) $data['name'],
            options: array_map(static fn (mixed $value): DnsRecordSchemaFieldOption => DnsRecordSchemaFieldOption::fromArray(self::objectValue($value)), self::listValue($data['options'])),
            placeholder: $data['placeholder'] === null ? null : (string) $data['placeholder'],
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
        $data['default'] = $this->default === null ? null : $this->default;
        $data['help'] = $this->help === null ? null : $this->help;
        $data['hostname'] = $this->hostname;
        $data['label'] = $this->label;
        $data['lowercase'] = $this->lowercase;
        $data['max'] = $this->max === null ? null : $this->max;
        $data['max_length'] = $this->max_length === null ? null : $this->max_length;
        $data['min'] = $this->min === null ? null : $this->min;
        $data['name'] = $this->name;
        $data['options'] = array_map(static fn (DnsRecordSchemaFieldOption $value) => $value->toArray(), $this->options);
        $data['placeholder'] = $this->placeholder === null ? null : $this->placeholder;
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
