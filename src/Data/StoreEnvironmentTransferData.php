<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\EnvironmentTransferSecretPolicy;

final readonly class StoreEnvironmentTransferData
{
    /**
     * @param  list<StoreEnvironmentTransferResourceData>  $resources
     */
    public function __construct(
        public array $resources,
        public EnvironmentTransferSecretPolicy $secret_policy,
        public string $source_environment_id,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            resources: array_map(static fn (mixed $value): StoreEnvironmentTransferResourceData => StoreEnvironmentTransferResourceData::fromArray(self::objectValue($value)), self::listValue($data['resources'])),
            secret_policy: EnvironmentTransferSecretPolicy::from((string) $data['secret_policy']),
            source_environment_id: (string) $data['source_environment_id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['resources'] = array_map(static fn (StoreEnvironmentTransferResourceData $value) => $value->toArray(), $this->resources);
        $data['secret_policy'] = $this->secret_policy->value;
        $data['source_environment_id'] = $this->source_environment_id;

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
