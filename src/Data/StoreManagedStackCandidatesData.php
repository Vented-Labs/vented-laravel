<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StoreManagedStackCandidatesData
{
    /**
     * @param  array<string, mixed>  $configuration
     */
    public function __construct(
        public array $configuration,
        public string $definition_revision,
        public ?string $stack_id,
        public string $stack_identifier,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            configuration: self::objectValue($data['configuration']),
            definition_revision: (string) $data['definition_revision'],
            stack_id: $data['stack_id'] === null ? null : (string) $data['stack_id'],
            stack_identifier: (string) $data['stack_identifier'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['configuration'] = $this->configuration;
        $data['definition_revision'] = $this->definition_revision;
        $data['stack_id'] = $this->stack_id === null ? null : $this->stack_id;
        $data['stack_identifier'] = $this->stack_identifier;

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
