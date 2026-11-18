<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BuildGroupData
{
    /**
     * @param  list<string>  $build_config_ids
     */
    public function __construct(
        public array $build_config_ids,
        public string $created_at,
        public string $id,
        public string $name,
        public ?string $repository,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            build_config_ids: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['build_config_ids'])),
            created_at: (string) $data['created_at'],
            id: (string) $data['id'],
            name: (string) $data['name'],
            repository: $data['repository'] === null ? null : (string) $data['repository'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['build_config_ids'] = $this->build_config_ids;
        $data['created_at'] = $this->created_at;
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['repository'] = $this->repository === null ? null : $this->repository;

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
