<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ApiTokenReachableOrganizationData
{
    /**
     * @param  list<ApiTokenReachableProjectData>  $projects
     */
    public function __construct(
        public string $id,
        public string $name,
        public array $projects,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) $data['id'],
            name: (string) $data['name'],
            projects: array_map(static fn (mixed $value): ApiTokenReachableProjectData => ApiTokenReachableProjectData::fromArray(self::objectValue($value)), self::listValue($data['projects'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['projects'] = array_map(static fn (ApiTokenReachableProjectData $value) => $value->toArray(), $this->projects);

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
