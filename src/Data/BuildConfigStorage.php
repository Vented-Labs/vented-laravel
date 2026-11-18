<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BuildConfigStorage
{
    /**
     * @param  list<BuildConfigStorageApp>  $apps
     */
    public function __construct(
        public array $apps,
        public string $id,
        public string $name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            apps: array_map(static fn (mixed $value): BuildConfigStorageApp => BuildConfigStorageApp::fromArray(self::objectValue($value)), self::listValue($data['apps'])),
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
        $data['apps'] = array_map(static fn (BuildConfigStorageApp $value) => $value->toArray(), $this->apps);
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
