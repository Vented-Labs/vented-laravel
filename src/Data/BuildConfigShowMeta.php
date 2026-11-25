<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BuildConfigShowMeta
{
    /**
     * @param  list<BuildData>  $builds
     */
    public function __construct(
        public array $builds,
        public int $builds_count,
        public DeployTargetOption $deploy_target,
        public ?BuildData $live_build,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            builds: array_map(static fn (mixed $value): BuildData => BuildData::fromArray(self::objectValue($value)), self::listValue($data['builds'])),
            builds_count: (int) $data['builds_count'],
            deploy_target: DeployTargetOption::fromArray(self::objectValue($data['deploy_target'])),
            live_build: $data['live_build'] === null ? null : BuildData::fromArray(self::objectValue($data['live_build'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['builds'] = array_map(static fn (BuildData $value) => $value->toArray(), $this->builds);
        $data['builds_count'] = $this->builds_count;
        $data['deploy_target'] = $this->deploy_target->toArray();
        $data['live_build'] = $this->live_build === null ? null : $this->live_build->toArray();

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
