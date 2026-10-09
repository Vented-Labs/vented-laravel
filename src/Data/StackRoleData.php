<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StackRoleData
{
    /**
     * @param  list<StackRoleOptionData>  $options
     */
    public function __construct(
        public ?StackConditionData $allowed_when,
        public string $key,
        public string $label,
        public int $maximum,
        public int $minimum,
        public ?string $mount_point,
        public array $options,
        public ?StackConditionData $required_when,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            allowed_when: $data['allowed_when'] === null ? null : StackConditionData::fromArray(self::objectValue($data['allowed_when'])),
            key: (string) $data['key'],
            label: (string) $data['label'],
            maximum: (int) $data['maximum'],
            minimum: (int) $data['minimum'],
            mount_point: $data['mount_point'] === null ? null : (string) $data['mount_point'],
            options: array_map(static fn (mixed $value): StackRoleOptionData => StackRoleOptionData::fromArray(self::objectValue($value)), self::listValue($data['options'])),
            required_when: $data['required_when'] === null ? null : StackConditionData::fromArray(self::objectValue($data['required_when'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['allowed_when'] = $this->allowed_when === null ? null : $this->allowed_when->toArray();
        $data['key'] = $this->key;
        $data['label'] = $this->label;
        $data['maximum'] = $this->maximum;
        $data['minimum'] = $this->minimum;
        $data['mount_point'] = $this->mount_point === null ? null : $this->mount_point;
        $data['options'] = array_map(static fn (StackRoleOptionData $value) => $value->toArray(), $this->options);
        $data['required_when'] = $this->required_when === null ? null : $this->required_when->toArray();

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
