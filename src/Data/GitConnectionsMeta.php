<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class GitConnectionsMeta
{
    /**
     * @param  list<FormOption>  $projects
     */
    public function __construct(
        public bool $can_manage,
        public ?string $github_connect_url,
        public ?string $gitlab_connect_url,
        public string $organization_id,
        public string $organization_name,
        public array $projects,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_manage: (bool) $data['can_manage'],
            github_connect_url: $data['github_connect_url'] === null ? null : (string) $data['github_connect_url'],
            gitlab_connect_url: $data['gitlab_connect_url'] === null ? null : (string) $data['gitlab_connect_url'],
            organization_id: (string) $data['organization_id'],
            organization_name: (string) $data['organization_name'],
            projects: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['projects'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_manage'] = $this->can_manage;
        $data['github_connect_url'] = $this->github_connect_url === null ? null : $this->github_connect_url;
        $data['gitlab_connect_url'] = $this->gitlab_connect_url === null ? null : $this->gitlab_connect_url;
        $data['organization_id'] = $this->organization_id;
        $data['organization_name'] = $this->organization_name;
        $data['projects'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->projects);

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
