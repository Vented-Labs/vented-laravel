<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\EnvironmentTransferResourceType;

final readonly class EnvironmentTransferResourceGroupData
{
    /**
     * @param  list<EnvironmentTransferResourceOptionData>  $resources
     */
    public function __construct(
        public string $group,
        public string $label,
        public array $resources,
        public EnvironmentTransferResourceType $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            group: (string) $data['group'],
            label: (string) $data['label'],
            resources: array_map(static fn (mixed $value): EnvironmentTransferResourceOptionData => EnvironmentTransferResourceOptionData::fromArray(self::objectValue($value)), self::listValue($data['resources'])),
            type: EnvironmentTransferResourceType::from((string) $data['type']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['group'] = $this->group;
        $data['label'] = $this->label;
        $data['resources'] = array_map(static fn (EnvironmentTransferResourceOptionData $value) => $value->toArray(), $this->resources);
        $data['type'] = $this->type->value;

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
