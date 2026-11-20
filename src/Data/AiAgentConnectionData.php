<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AiAgentConnectionData
{
    /**
     * @param  list<string>|null  $environments
     * @param  list<string>  $projects
     */
    public function __construct(
        public ?string $color,
        public string $connected_at,
        public ?array $environments,
        public string $expires_at,
        public ?string $icon,
        public string $id,
        public ?string $last_used_at,
        public string $name,
        public ?string $organization,
        public ?string $paused_until,
        public array $projects,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            color: $data['color'] === null ? null : (string) $data['color'],
            connected_at: (string) $data['connected_at'],
            environments: $data['environments'] === null ? null : array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['environments'])),
            expires_at: (string) $data['expires_at'],
            icon: $data['icon'] === null ? null : (string) $data['icon'],
            id: (string) $data['id'],
            last_used_at: $data['last_used_at'] === null ? null : (string) $data['last_used_at'],
            name: (string) $data['name'],
            organization: $data['organization'] === null ? null : (string) $data['organization'],
            paused_until: $data['paused_until'] === null ? null : (string) $data['paused_until'],
            projects: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['projects'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['color'] = $this->color === null ? null : $this->color;
        $data['connected_at'] = $this->connected_at;
        $data['environments'] = $this->environments === null ? null : $this->environments;
        $data['expires_at'] = $this->expires_at;
        $data['icon'] = $this->icon === null ? null : $this->icon;
        $data['id'] = $this->id;
        $data['last_used_at'] = $this->last_used_at === null ? null : $this->last_used_at;
        $data['name'] = $this->name;
        $data['organization'] = $this->organization === null ? null : $this->organization;
        $data['paused_until'] = $this->paused_until === null ? null : $this->paused_until;
        $data['projects'] = $this->projects;

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
