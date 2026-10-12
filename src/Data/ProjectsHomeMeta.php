<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ProjectsHomeMeta
{
    /**
     * @param  list<DashboardProjectData>  $projects
     */
    public function __construct(
        public GettingStartedData $getting_started,
        public string $greeting,
        public array $projects,
        public bool $two_factor_enabled,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            getting_started: GettingStartedData::fromArray(self::objectValue($data['getting_started'])),
            greeting: (string) $data['greeting'],
            projects: array_map(static fn (mixed $value): DashboardProjectData => DashboardProjectData::fromArray(self::objectValue($value)), self::listValue($data['projects'])),
            two_factor_enabled: (bool) $data['two_factor_enabled'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['getting_started'] = $this->getting_started->toArray();
        $data['greeting'] = $this->greeting;
        $data['projects'] = array_map(static fn (DashboardProjectData $value) => $value->toArray(), $this->projects);
        $data['two_factor_enabled'] = $this->two_factor_enabled;

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
