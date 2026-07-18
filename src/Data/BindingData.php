<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\BindableType;
use Vented\Enums\BindingStatus;

final readonly class BindingData
{
    public function __construct(
        public string $id,
        public BindingEndpoint $source,
        public string $source_id,
        public BindableType $source_type,
        public BindingStatus $status,
        public BindingEndpoint $target,
        public string $target_id,
        public BindableType $target_type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) $data['id'],
            source: BindingEndpoint::fromArray(self::objectValue($data['source'])),
            source_id: (string) $data['source_id'],
            source_type: BindableType::from((string) $data['source_type']),
            status: BindingStatus::from((string) $data['status']),
            target: BindingEndpoint::fromArray(self::objectValue($data['target'])),
            target_id: (string) $data['target_id'],
            target_type: BindableType::from((string) $data['target_type']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = $this->id;
        $data['source'] = $this->source->toArray();
        $data['source_id'] = $this->source_id;
        $data['source_type'] = $this->source_type->value;
        $data['status'] = $this->status->value;
        $data['target'] = $this->target->toArray();
        $data['target_id'] = $this->target_id;
        $data['target_type'] = $this->target_type->value;

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
