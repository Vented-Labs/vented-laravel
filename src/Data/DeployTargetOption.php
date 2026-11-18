<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\DeployTargetKind;

final readonly class DeployTargetOption
{
    /**
     * @param  list<string>  $members
     */
    public function __construct(
        public ?string $description,
        public string $id,
        public DeployTargetKind $kind,
        public string $label,
        public array $members,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            description: $data['description'] === null ? null : (string) $data['description'],
            id: (string) $data['id'],
            kind: DeployTargetKind::from((string) $data['kind']),
            label: (string) $data['label'],
            members: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['members'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['description'] = $this->description === null ? null : $this->description;
        $data['id'] = $this->id;
        $data['kind'] = $this->kind->value;
        $data['label'] = $this->label;
        $data['members'] = $this->members;

        return $data;
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
