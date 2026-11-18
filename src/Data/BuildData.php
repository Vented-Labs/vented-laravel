<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BuildData
{
    /**
     * @param  list<BuildStepData>  $steps
     */
    public function __construct(
        public NamedOption $build_config,
        public ?string $commit_sha,
        public ?string $completed_at,
        public string $created_at,
        public BuildDeployRef $deploy,
        public string $id,
        public bool $is_live,
        public ?string $started_at,
        public StatusData $status,
        public array $steps,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            build_config: NamedOption::fromArray(self::objectValue($data['build_config'])),
            commit_sha: $data['commit_sha'] === null ? null : (string) $data['commit_sha'],
            completed_at: $data['completed_at'] === null ? null : (string) $data['completed_at'],
            created_at: (string) $data['created_at'],
            deploy: BuildDeployRef::fromArray(self::objectValue($data['deploy'])),
            id: (string) $data['id'],
            is_live: (bool) $data['is_live'],
            started_at: $data['started_at'] === null ? null : (string) $data['started_at'],
            status: StatusData::fromArray(self::objectValue($data['status'])),
            steps: array_map(static fn (mixed $value): BuildStepData => BuildStepData::fromArray(self::objectValue($value)), self::listValue($data['steps'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['build_config'] = $this->build_config->toArray();
        $data['commit_sha'] = $this->commit_sha === null ? null : $this->commit_sha;
        $data['completed_at'] = $this->completed_at === null ? null : $this->completed_at;
        $data['created_at'] = $this->created_at;
        $data['deploy'] = $this->deploy->toArray();
        $data['id'] = $this->id;
        $data['is_live'] = $this->is_live;
        $data['started_at'] = $this->started_at === null ? null : $this->started_at;
        $data['status'] = $this->status->toArray();
        $data['steps'] = array_map(static fn (BuildStepData $value) => $value->toArray(), $this->steps);

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
