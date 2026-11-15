<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ApiTokenScopeData
{
    /**
     * @param  list<ApiTokenPermissionData>  $permissions
     */
    public function __construct(
        public string $description,
        public string $label,
        public array $permissions,
        public string $value,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            description: (string) $data['description'],
            label: (string) $data['label'],
            permissions: array_map(static fn (mixed $value): ApiTokenPermissionData => ApiTokenPermissionData::fromArray(self::objectValue($value)), self::listValue($data['permissions'])),
            value: (string) $data['value'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['description'] = $this->description;
        $data['label'] = $this->label;
        $data['permissions'] = array_map(static fn (ApiTokenPermissionData $value) => $value->toArray(), $this->permissions);
        $data['value'] = $this->value;

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
