<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ApiTokenScopeGroupData
{
    /**
     * @param  list<ApiTokenScopeData>  $scopes
     */
    public function __construct(
        public string $label,
        public array $scopes,
        public string $value,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            label: (string) $data['label'],
            scopes: array_map(static fn (mixed $value): ApiTokenScopeData => ApiTokenScopeData::fromArray(self::objectValue($value)), self::listValue($data['scopes'])),
            value: (string) $data['value'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['label'] = $this->label;
        $data['scopes'] = array_map(static fn (ApiTokenScopeData $value) => $value->toArray(), $this->scopes);
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
