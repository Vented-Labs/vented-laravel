<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ServiceData
{
    public function __construct(
        public string $created_at,
        public ?string $icon,
        public string $id,
        public string $name,
        public StatusData $status,
        public ?ResourceTelemetry $telemetry,
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
            created_at: (string) $data['created_at'],
            icon: $data['icon'] === null ? null : (string) $data['icon'],
            id: (string) $data['id'],
            name: (string) $data['name'],
            status: StatusData::fromArray(self::objectValue($data['status'])),
            telemetry: $data['telemetry'] === null ? null : ResourceTelemetry::fromArray(self::objectValue($data['telemetry'])),
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
        $data['created_at'] = $this->created_at;
        $data['icon'] = $this->icon === null ? null : $this->icon;
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['status'] = $this->status->toArray();
        $data['telemetry'] = $this->telemetry === null ? null : $this->telemetry->toArray();
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
