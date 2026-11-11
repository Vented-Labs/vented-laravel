<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ServiceOutputsData
{
    /**
     * @param  list<ServiceOutputData>  $outputs
     */
    public function __construct(
        public string $id,
        public array $outputs,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) $data['id'],
            outputs: array_map(static fn (mixed $value): ServiceOutputData => ServiceOutputData::fromArray(self::objectValue($value)), self::listValue($data['outputs'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = $this->id;
        $data['outputs'] = array_map(static fn (ServiceOutputData $value) => $value->toArray(), $this->outputs);

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
