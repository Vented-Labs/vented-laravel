<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class NotificationData
{
    public function __construct(
        public ?AgentActivityData $agent,
        public string $body,
        public ?string $created_at,
        public ?string $icon,
        public string $id,
        public ?string $kind,
        public bool $read,
        public string $title,
        public string $tone,
        public ?string $url,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            agent: $data['agent'] === null ? null : AgentActivityData::fromArray(self::objectValue($data['agent'])),
            body: (string) $data['body'],
            created_at: $data['created_at'] === null ? null : (string) $data['created_at'],
            icon: $data['icon'] === null ? null : (string) $data['icon'],
            id: (string) $data['id'],
            kind: $data['kind'] === null ? null : (string) $data['kind'],
            read: (bool) $data['read'],
            title: (string) $data['title'],
            tone: (string) $data['tone'],
            url: $data['url'] === null ? null : (string) $data['url'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['agent'] = $this->agent === null ? null : $this->agent->toArray();
        $data['body'] = $this->body;
        $data['created_at'] = $this->created_at === null ? null : $this->created_at;
        $data['icon'] = $this->icon === null ? null : $this->icon;
        $data['id'] = $this->id;
        $data['kind'] = $this->kind === null ? null : $this->kind;
        $data['read'] = $this->read;
        $data['title'] = $this->title;
        $data['tone'] = $this->tone;
        $data['url'] = $this->url === null ? null : $this->url;

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
