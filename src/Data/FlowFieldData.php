<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class FlowFieldData
{
    /**
     * @param  array<string, mixed>  $props
     */
    public function __construct(
        public ?string $help,
        public string $key,
        public string $label,
        public array $props,
        public bool $required,
        public string $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            help: $data['help'] === null ? null : (string) $data['help'],
            key: (string) $data['key'],
            label: (string) $data['label'],
            props: self::objectValue($data['props']),
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
        $data['help'] = $this->help === null ? null : $this->help;
        $data['key'] = $this->key;
        $data['label'] = $this->label;
        $data['props'] = $this->props;
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
