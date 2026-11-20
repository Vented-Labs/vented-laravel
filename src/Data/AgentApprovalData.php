<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AgentApprovalData
{
    /**
     * @param  list<array<string, mixed>>  $targets
     */
    public function __construct(
        public string $action,
        public ?string $agent_color,
        public ?string $agent_icon,
        public string $agent_name,
        public ?string $agent_reason,
        public string $created_at,
        public bool $decidable,
        public string $expires_at,
        public string $id,
        public bool $permanent,
        public ?string $result_message,
        public StatusData $status,
        public array $targets,
        public string $url,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            action: (string) $data['action'],
            agent_color: $data['agent_color'] === null ? null : (string) $data['agent_color'],
            agent_icon: $data['agent_icon'] === null ? null : (string) $data['agent_icon'],
            agent_name: (string) $data['agent_name'],
            agent_reason: $data['agent_reason'] === null ? null : (string) $data['agent_reason'],
            created_at: (string) $data['created_at'],
            decidable: (bool) $data['decidable'],
            expires_at: (string) $data['expires_at'],
            id: (string) $data['id'],
            permanent: (bool) $data['permanent'],
            result_message: $data['result_message'] === null ? null : (string) $data['result_message'],
            status: StatusData::fromArray(self::objectValue($data['status'])),
            targets: array_map(static fn (mixed $value): array => self::objectValue($value), self::listValue($data['targets'])),
            url: (string) $data['url'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['action'] = $this->action;
        $data['agent_color'] = $this->agent_color === null ? null : $this->agent_color;
        $data['agent_icon'] = $this->agent_icon === null ? null : $this->agent_icon;
        $data['agent_name'] = $this->agent_name;
        $data['agent_reason'] = $this->agent_reason === null ? null : $this->agent_reason;
        $data['created_at'] = $this->created_at;
        $data['decidable'] = $this->decidable;
        $data['expires_at'] = $this->expires_at;
        $data['id'] = $this->id;
        $data['permanent'] = $this->permanent;
        $data['result_message'] = $this->result_message === null ? null : $this->result_message;
        $data['status'] = $this->status->toArray();
        $data['targets'] = $this->targets;
        $data['url'] = $this->url;

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
