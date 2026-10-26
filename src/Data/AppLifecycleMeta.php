<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppLifecycleMeta
{
    public function __construct(
        public AppLifecycleOperationData $operation,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            operation: AppLifecycleOperationData::fromArray(self::objectValue($data['operation'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['operation'] = $this->operation->toArray();

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
