<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\DeployTriggerType;

final readonly class DeployData
{
    public function __construct(
        public InstallableRef $app,
        public ?string $commit_sha,
        public ?string $completed_at,
        public string $created_at,
        public string $id,
        public ?IntegrationRef $integration,
        public ?string $message,
        public ?string $ref,
        public ?string $started_at,
        public string $status,
        public string $status_color,
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
            app: InstallableRef::fromArray(self::objectValue($data['app'])),
            commit_sha: $data['commit_sha'] === null ? null : (string) $data['commit_sha'],
            completed_at: $data['completed_at'] === null ? null : (string) $data['completed_at'],
            created_at: (string) $data['created_at'],
            id: (string) $data['id'],
            integration: $data['integration'] === null ? null : IntegrationRef::fromArray(self::objectValue($data['integration'])),
            message: $data['message'] === null ? null : (string) $data['message'],
            ref: $data['ref'] === null ? null : (string) $data['ref'],
            started_at: $data['started_at'] === null ? null : (string) $data['started_at'],
            status: (string) $data['status'],
            status_color: (string) $data['status_color'],
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
        $data['app'] = $this->app->toArray();
        $data['commit_sha'] = $this->commit_sha === null ? null : $this->commit_sha;
        $data['completed_at'] = $this->completed_at === null ? null : $this->completed_at;
        $data['created_at'] = $this->created_at;
        $data['id'] = $this->id;
        $data['integration'] = $this->integration === null ? null : $this->integration->toArray();
        $data['message'] = $this->message === null ? null : $this->message;
        $data['ref'] = $this->ref === null ? null : $this->ref;
        $data['started_at'] = $this->started_at === null ? null : $this->started_at;
        $data['status'] = $this->status;
        $data['status_color'] = $this->status_color;
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
}
