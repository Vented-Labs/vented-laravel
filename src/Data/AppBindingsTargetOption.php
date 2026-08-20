<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppBindingsTargetOption
{
    public function __construct(
        public EnvironmentRef $environment,
        public string $id,
        public string $name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            environment: EnvironmentRef::fromArray(self::objectValue($data['environment'])),
            id: (string) $data['id'],
            name: (string) $data['name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['environment'] = $this->environment->toArray();
        $data['id'] = $this->id;
        $data['name'] = $this->name;

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
