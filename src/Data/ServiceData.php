<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ServiceData
{
    public function __construct(
        public bool $available,
        public bool $can_delete,
        public string $created_at,
        public ?string $icon,
        public string $id,
        public ?string $kind,
        public ?string $kind_name,
        public string $name,
        public StatusData $status,
        public string $type,
        public string $type_name,
        public string $updated_at,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            available: (bool) $data['available'],
            can_delete: (bool) $data['can_delete'],
            created_at: (string) $data['created_at'],
            icon: $data['icon'] === null ? null : (string) $data['icon'],
            id: (string) $data['id'],
            kind: $data['kind'] === null ? null : (string) $data['kind'],
            kind_name: $data['kind_name'] === null ? null : (string) $data['kind_name'],
            name: (string) $data['name'],
            status: StatusData::fromArray(self::objectValue($data['status'])),
            type: (string) $data['type'],
            type_name: (string) $data['type_name'],
            updated_at: (string) $data['updated_at'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['available'] = $this->available;
        $data['can_delete'] = $this->can_delete;
        $data['created_at'] = $this->created_at;
        $data['icon'] = $this->icon === null ? null : $this->icon;
        $data['id'] = $this->id;
        $data['kind'] = $this->kind === null ? null : $this->kind;
        $data['kind_name'] = $this->kind_name === null ? null : $this->kind_name;
        $data['name'] = $this->name;
        $data['status'] = $this->status->toArray();
        $data['type'] = $this->type;
        $data['type_name'] = $this->type_name;
        $data['updated_at'] = $this->updated_at;

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
