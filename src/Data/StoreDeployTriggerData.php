<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\DeployTriggerType;
use Vented\OptionalValue;

final readonly class StoreDeployTriggerData
{
    public function __construct(
        public string $app_id,
        public ?string $cron_expression,
        public ?string $integration_id,
        public string $name,
        public DeployTriggerType $type,
        public ?string $webhook_secret,
        public bool|OptionalValue $enabled = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            app_id: (string) $data['app_id'],
            cron_expression: $data['cron_expression'] === null ? null : (string) $data['cron_expression'],
            integration_id: $data['integration_id'] === null ? null : (string) $data['integration_id'],
            name: (string) $data['name'],
            type: DeployTriggerType::from((string) $data['type']),
            webhook_secret: $data['webhook_secret'] === null ? null : (string) $data['webhook_secret'],
            enabled: array_key_exists('enabled', $data) ? (bool) $data['enabled'] : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['app_id'] = $this->app_id;
        $data['cron_expression'] = $this->cron_expression === null ? null : $this->cron_expression;
        $data['integration_id'] = $this->integration_id === null ? null : $this->integration_id;
        $data['name'] = $this->name;
        $data['type'] = $this->type->value;
        $data['webhook_secret'] = $this->webhook_secret === null ? null : $this->webhook_secret;
        if ($this->enabled !== OptionalValue::Missing) {
            $data['enabled'] = $this->enabled;
        }

        return $data;
    }
}
