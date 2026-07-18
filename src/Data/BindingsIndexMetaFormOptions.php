<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BindingsIndexMetaFormOptions
{
    /**
     * @param  list<BindingCandidate>  $candidates
     */
    public function __construct(
        public array $candidates,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            candidates: array_map(static fn (mixed $value): BindingCandidate => BindingCandidate::fromArray(self::objectValue($value)), self::listValue($data['candidates'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['candidates'] = array_map(static fn (BindingCandidate $value) => $value->toArray(), $this->candidates);

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
