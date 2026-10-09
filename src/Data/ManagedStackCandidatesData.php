<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ManagedStackCandidatesData
{
    /**
     * @param  list<StackCandidateResourceData>  $candidates
     * @param  array<string, mixed>  $configuration
     */
    public function __construct(
        public array $candidates,
        public array $configuration,
        public string $id,
        public string $identifier,
        public string $revision,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            candidates: array_map(static fn (mixed $value): StackCandidateResourceData => StackCandidateResourceData::fromArray(self::objectValue($value)), self::listValue($data['candidates'])),
            configuration: self::objectValue($data['configuration']),
            id: (string) $data['id'],
            identifier: (string) $data['identifier'],
            revision: (string) $data['revision'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['candidates'] = array_map(static fn (StackCandidateResourceData $value) => $value->toArray(), $this->candidates);
        $data['configuration'] = $this->configuration;
        $data['id'] = $this->id;
        $data['identifier'] = $this->identifier;
        $data['revision'] = $this->revision;

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
