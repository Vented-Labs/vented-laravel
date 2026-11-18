<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class DeploysIndexMetaFormOptions
{
    /**
     * @param  list<DeployTargetOption>  $targets
     */
    public function __construct(
        public array $targets,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            targets: array_map(static fn (mixed $value): DeployTargetOption => DeployTargetOption::fromArray(self::objectValue($value)), self::listValue($data['targets'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['targets'] = array_map(static fn (DeployTargetOption $value) => $value->toArray(), $this->targets);

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
