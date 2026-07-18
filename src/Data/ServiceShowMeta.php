<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ServiceShowMeta
{
    public function __construct(
        public Monitoring $monitoring,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            monitoring: Monitoring::fromArray(self::objectValue($data['monitoring'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['monitoring'] = $this->monitoring->toArray();

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
