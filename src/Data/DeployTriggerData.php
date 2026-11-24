<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\DeployTriggerType;

final readonly class DeployTriggerData
{
    public function __construct(
        public ?NamedOption $build_config,
        public DeployTriggerConfigData $config,
        public string $created_at,
        public bool $enabled,
        public string $id,
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
            build_config: $data['build_config'] === null ? null : NamedOption::fromArray(self::objectValue($data['build_config'])),
            config: DeployTriggerConfigData::fromArray(self::objectValue($data['config'])),
            created_at: (string) $data['created_at'],
            enabled: (bool) $data['enabled'],
            id: (string) $data['id'],
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
        $data['build_config'] = $this->build_config === null ? null : $this->build_config->toArray();
        $data['config'] = $this->config->toArray();
        $data['created_at'] = $this->created_at;
        $data['enabled'] = $this->enabled;
        $data['id'] = $this->id;
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
}
