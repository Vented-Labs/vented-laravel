<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StoreManagedStackOperationData
{
    /**
     * @param  list<StoreManagedStackCleanupTargetData>  $targets
     */
    public function __construct(
        public string $idempotency_key,
        public string $stack_id,
        public array $targets,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            idempotency_key: (string) $data['idempotency_key'],
            stack_id: (string) $data['stack_id'],
            targets: array_map(static fn (mixed $value): StoreManagedStackCleanupTargetData => StoreManagedStackCleanupTargetData::fromArray(self::objectValue($value)), self::listValue($data['targets'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['idempotency_key'] = $this->idempotency_key;
        $data['stack_id'] = $this->stack_id;
        $data['targets'] = array_map(static fn (StoreManagedStackCleanupTargetData $value) => $value->toArray(), $this->targets);

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
