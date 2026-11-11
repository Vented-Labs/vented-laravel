<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\BindableType;

final readonly class BindingData
{
    /**
     * @param  list<string>  $variables
     */
    public function __construct(
        public bool $can_rotate,
        public int $credentials_revision,
        public int $declaration_generation,
        public string $id,
        public ?string $purpose,
        public BindingEndpoint $source,
        public string $source_id,
        public BindableType $source_type,
        public StatusData $status,
        public BindingEndpoint $target,
        public string $target_id,
        public BindableType $target_type,
        public array $variables,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_rotate: (bool) $data['can_rotate'],
            credentials_revision: (int) $data['credentials_revision'],
            declaration_generation: (int) $data['declaration_generation'],
            id: (string) $data['id'],
            purpose: $data['purpose'] === null ? null : (string) $data['purpose'],
            source: BindingEndpoint::fromArray(self::objectValue($data['source'])),
            source_id: (string) $data['source_id'],
            source_type: BindableType::from((string) $data['source_type']),
            status: StatusData::fromArray(self::objectValue($data['status'])),
            target: BindingEndpoint::fromArray(self::objectValue($data['target'])),
            target_id: (string) $data['target_id'],
            target_type: BindableType::from((string) $data['target_type']),
            variables: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['variables'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_rotate'] = $this->can_rotate;
        $data['credentials_revision'] = $this->credentials_revision;
        $data['declaration_generation'] = $this->declaration_generation;
        $data['id'] = $this->id;
        $data['purpose'] = $this->purpose === null ? null : $this->purpose;
        $data['source'] = $this->source->toArray();
        $data['source_id'] = $this->source_id;
        $data['source_type'] = $this->source_type->value;
        $data['status'] = $this->status->toArray();
        $data['target'] = $this->target->toArray();
        $data['target_id'] = $this->target_id;
        $data['target_type'] = $this->target_type->value;
        $data['variables'] = $this->variables;

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
