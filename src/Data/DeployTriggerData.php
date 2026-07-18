<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\DeployTriggerType;

final readonly class DeployTriggerData
{
    /**
     * @param  list<string>|null  $config
     */
    public function __construct(
        public InstallableRef $app,
        public ?array $config,
        public string $created_at,
        public bool $enabled,
        public string $id,
        public ?IntegrationRef $integration,
        public string $name,
        public DeployTriggerType $type,
        public ?string $webhook_secret,
        public ?string $webhook_url,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            app: InstallableRef::fromArray(self::objectValue($data['app'])),
            config: $data['config'] === null ? null : array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['config'])),
            created_at: (string) $data['created_at'],
            enabled: (bool) $data['enabled'],
            id: (string) $data['id'],
            integration: $data['integration'] === null ? null : IntegrationRef::fromArray(self::objectValue($data['integration'])),
            name: (string) $data['name'],
            type: DeployTriggerType::from((string) $data['type']),
            webhook_secret: $data['webhook_secret'] === null ? null : (string) $data['webhook_secret'],
            webhook_url: $data['webhook_url'] === null ? null : (string) $data['webhook_url'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['app'] = $this->app->toArray();
        $data['config'] = $this->config === null ? null : $this->config;
        $data['created_at'] = $this->created_at;
        $data['enabled'] = $this->enabled;
        $data['id'] = $this->id;
        $data['integration'] = $this->integration === null ? null : $this->integration->toArray();
        $data['name'] = $this->name;
        $data['type'] = $this->type->value;
        $data['webhook_secret'] = $this->webhook_secret === null ? null : $this->webhook_secret;
        $data['webhook_url'] = $this->webhook_url === null ? null : $this->webhook_url;

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
