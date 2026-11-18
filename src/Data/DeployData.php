<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\DeployTriggerType;

final readonly class DeployData
{
    /**
     * @param  list<DeployBuildRef>  $builds
     */
    public function __construct(
        public ?InstallableRef $app,
        public ?NamedOption $build_config,
        public ?NamedOption $build_group,
        public array $builds,
        public ?string $commit_sha,
        public ?string $completed_at,
        public string $created_at,
        public string $id,
        public ?IntegrationRef $integration,
        public ?string $message,
        public ?string $outcome,
        public ?string $ref,
        public ?string $started_at,
        public StatusData $status,
        public ?DeployTriggerRef $trigger,
        public DeployTriggerType $trigger_type,
        public ?UserRef $triggered_by,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            app: $data['app'] === null ? null : InstallableRef::fromArray(self::objectValue($data['app'])),
            build_config: $data['build_config'] === null ? null : NamedOption::fromArray(self::objectValue($data['build_config'])),
            build_group: $data['build_group'] === null ? null : NamedOption::fromArray(self::objectValue($data['build_group'])),
            builds: array_map(static fn (mixed $value): DeployBuildRef => DeployBuildRef::fromArray(self::objectValue($value)), self::listValue($data['builds'])),
            commit_sha: $data['commit_sha'] === null ? null : (string) $data['commit_sha'],
            completed_at: $data['completed_at'] === null ? null : (string) $data['completed_at'],
            created_at: (string) $data['created_at'],
            id: (string) $data['id'],
            integration: $data['integration'] === null ? null : IntegrationRef::fromArray(self::objectValue($data['integration'])),
            message: $data['message'] === null ? null : (string) $data['message'],
            outcome: $data['outcome'] === null ? null : (string) $data['outcome'],
            ref: $data['ref'] === null ? null : (string) $data['ref'],
            started_at: $data['started_at'] === null ? null : (string) $data['started_at'],
            status: StatusData::fromArray(self::objectValue($data['status'])),
            trigger: $data['trigger'] === null ? null : DeployTriggerRef::fromArray(self::objectValue($data['trigger'])),
            trigger_type: DeployTriggerType::from((string) $data['trigger_type']),
            triggered_by: $data['triggered_by'] === null ? null : UserRef::fromArray(self::objectValue($data['triggered_by'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['app'] = $this->app === null ? null : $this->app->toArray();
        $data['build_config'] = $this->build_config === null ? null : $this->build_config->toArray();
        $data['build_group'] = $this->build_group === null ? null : $this->build_group->toArray();
        $data['builds'] = array_map(static fn (DeployBuildRef $value) => $value->toArray(), $this->builds);
        $data['commit_sha'] = $this->commit_sha === null ? null : $this->commit_sha;
        $data['completed_at'] = $this->completed_at === null ? null : $this->completed_at;
        $data['created_at'] = $this->created_at;
        $data['id'] = $this->id;
        $data['integration'] = $this->integration === null ? null : $this->integration->toArray();
        $data['message'] = $this->message === null ? null : $this->message;
        $data['outcome'] = $this->outcome === null ? null : $this->outcome;
        $data['ref'] = $this->ref === null ? null : $this->ref;
        $data['started_at'] = $this->started_at === null ? null : $this->started_at;
        $data['status'] = $this->status->toArray();
        $data['trigger'] = $this->trigger === null ? null : $this->trigger->toArray();
        $data['trigger_type'] = $this->trigger_type->value;
        $data['triggered_by'] = $this->triggered_by === null ? null : $this->triggered_by->toArray();

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
