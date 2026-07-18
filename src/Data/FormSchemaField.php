<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class FormSchemaField
{
    /**
     * @param  list<FormSchemaField>  $fields
     * @param  list<string>|null  $group
     * @param  list<string>  $hidden_on
     * @param  list<string>  $hidden_options
     * @param  array<string, mixed>  $options
     * @param  list<string>|null  $visible_when
     */
    public function __construct(
        public bool $additional_properties,
        public ?string $confirm_for,
        public ?string $const,
        public ?string $default,
        public bool $dehydrated,
        public bool $encrypted,
        public array $fields,
        public ?array $group,
        public bool $has_const,
        public bool $has_default,
        public array $hidden_on,
        public array $hidden_options,
        public ?string $hint,
        public bool $inline,
        public string $label,
        public ?int $max,
        public ?int $max_items,
        public ?int $max_length,
        public ?string $max_version,
        public ?int $min,
        public ?int $min_items,
        public ?int $min_length,
        public ?string $min_version,
        public string $name,
        public ?int $option_columns,
        public array $options,
        public ?string $options_provider,
        public ?string $placeholder,
        public bool $required,
        public ?string $system_default,
        public string $type,
        public string $value_type,
        public ?array $visible_when,
        public ?int $width,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            additional_properties: (bool) $data['additional_properties'],
            confirm_for: $data['confirm_for'] === null ? null : (string) $data['confirm_for'],
            const: $data['const'] === null ? null : (string) $data['const'],
            default: $data['default'] === null ? null : (string) $data['default'],
            dehydrated: (bool) $data['dehydrated'],
            encrypted: (bool) $data['encrypted'],
            fields: array_map(static fn (mixed $value): FormSchemaField => FormSchemaField::fromArray(self::objectValue($value)), self::listValue($data['fields'])),
            group: $data['group'] === null ? null : array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['group'])),
            has_const: (bool) $data['has_const'],
            has_default: (bool) $data['has_default'],
            hidden_on: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['hidden_on'])),
            hidden_options: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['hidden_options'])),
            hint: $data['hint'] === null ? null : (string) $data['hint'],
            inline: (bool) $data['inline'],
            label: (string) $data['label'],
            max: $data['max'] === null ? null : (int) $data['max'],
            max_items: $data['max_items'] === null ? null : (int) $data['max_items'],
            max_length: $data['max_length'] === null ? null : (int) $data['max_length'],
            max_version: $data['max_version'] === null ? null : (string) $data['max_version'],
            min: $data['min'] === null ? null : (int) $data['min'],
            min_items: $data['min_items'] === null ? null : (int) $data['min_items'],
            min_length: $data['min_length'] === null ? null : (int) $data['min_length'],
            min_version: $data['min_version'] === null ? null : (string) $data['min_version'],
            name: (string) $data['name'],
            option_columns: $data['option_columns'] === null ? null : (int) $data['option_columns'],
            options: self::objectValue($data['options']),
            options_provider: $data['options_provider'] === null ? null : (string) $data['options_provider'],
            placeholder: $data['placeholder'] === null ? null : (string) $data['placeholder'],
            required: (bool) $data['required'],
            system_default: $data['system_default'] === null ? null : (string) $data['system_default'],
            type: (string) $data['type'],
            value_type: (string) $data['value_type'],
            visible_when: $data['visible_when'] === null ? null : array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['visible_when'])),
            width: $data['width'] === null ? null : (int) $data['width'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['additional_properties'] = $this->additional_properties;
        $data['confirm_for'] = $this->confirm_for === null ? null : $this->confirm_for;
        $data['const'] = $this->const === null ? null : $this->const;
        $data['default'] = $this->default === null ? null : $this->default;
        $data['dehydrated'] = $this->dehydrated;
        $data['encrypted'] = $this->encrypted;
        $data['fields'] = array_map(static fn (FormSchemaField $value) => $value->toArray(), $this->fields);
        $data['group'] = $this->group === null ? null : $this->group;
        $data['has_const'] = $this->has_const;
        $data['has_default'] = $this->has_default;
        $data['hidden_on'] = $this->hidden_on;
        $data['hidden_options'] = $this->hidden_options;
        $data['hint'] = $this->hint === null ? null : $this->hint;
        $data['inline'] = $this->inline;
        $data['label'] = $this->label;
        $data['max'] = $this->max === null ? null : $this->max;
        $data['max_items'] = $this->max_items === null ? null : $this->max_items;
        $data['max_length'] = $this->max_length === null ? null : $this->max_length;
        $data['max_version'] = $this->max_version === null ? null : $this->max_version;
        $data['min'] = $this->min === null ? null : $this->min;
        $data['min_items'] = $this->min_items === null ? null : $this->min_items;
        $data['min_length'] = $this->min_length === null ? null : $this->min_length;
        $data['min_version'] = $this->min_version === null ? null : $this->min_version;
        $data['name'] = $this->name;
        $data['option_columns'] = $this->option_columns === null ? null : $this->option_columns;
        $data['options'] = $this->options;
        $data['options_provider'] = $this->options_provider === null ? null : $this->options_provider;
        $data['placeholder'] = $this->placeholder === null ? null : $this->placeholder;
        $data['required'] = $this->required;
        $data['system_default'] = $this->system_default === null ? null : $this->system_default;
        $data['type'] = $this->type;
        $data['value_type'] = $this->value_type;
        $data['visible_when'] = $this->visible_when === null ? null : $this->visible_when;
        $data['width'] = $this->width === null ? null : $this->width;

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
