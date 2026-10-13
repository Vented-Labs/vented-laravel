<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ProjectData
{
    public function __construct(
        public bool $billing_configured,
        public string $created_at,
        public string $id,
        public bool $is_new,
        public string $name,
        public EnvironmentRef $production_environment,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            billing_configured: (bool) $data['billing_configured'],
            created_at: (string) $data['created_at'],
            id: (string) $data['id'],
            is_new: (bool) $data['is_new'],
            name: (string) $data['name'],
            production_environment: EnvironmentRef::fromArray(self::objectValue($data['production_environment'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['billing_configured'] = $this->billing_configured;
        $data['created_at'] = $this->created_at;
        $data['id'] = $this->id;
        $data['is_new'] = $this->is_new;
        $data['name'] = $this->name;
        $data['production_environment'] = $this->production_environment->toArray();

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
