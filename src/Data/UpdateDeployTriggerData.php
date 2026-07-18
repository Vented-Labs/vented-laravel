<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\DeployTriggerType;
use Vented\OptionalValue;

final readonly class UpdateDeployTriggerData
{
    public function __construct(
        public string|OptionalValue $app_id = OptionalValue::Missing,
        public string|null|OptionalValue $cron_expression = OptionalValue::Missing,
        public bool|OptionalValue $enabled = OptionalValue::Missing,
        public string|null|OptionalValue $integration_id = OptionalValue::Missing,
        public string|OptionalValue $name = OptionalValue::Missing,
        public DeployTriggerType|OptionalValue $type = OptionalValue::Missing,
        public string|null|OptionalValue $webhook_secret = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            app_id: array_key_exists('app_id', $data) ? (string) $data['app_id'] : OptionalValue::Missing,
            cron_expression: array_key_exists('cron_expression', $data) ? $data['cron_expression'] === null ? null : (string) $data['cron_expression'] : OptionalValue::Missing,
            enabled: array_key_exists('enabled', $data) ? (bool) $data['enabled'] : OptionalValue::Missing,
            integration_id: array_key_exists('integration_id', $data) ? $data['integration_id'] === null ? null : (string) $data['integration_id'] : OptionalValue::Missing,
            name: array_key_exists('name', $data) ? (string) $data['name'] : OptionalValue::Missing,
            type: array_key_exists('type', $data) ? DeployTriggerType::from((string) $data['type']) : OptionalValue::Missing,
            webhook_secret: array_key_exists('webhook_secret', $data) ? $data['webhook_secret'] === null ? null : (string) $data['webhook_secret'] : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->app_id !== OptionalValue::Missing) {
            $data['app_id'] = $this->app_id;
        }
        if ($this->cron_expression !== OptionalValue::Missing) {
            $data['cron_expression'] = $this->cron_expression === null ? null : $this->cron_expression;
        }
        if ($this->enabled !== OptionalValue::Missing) {
            $data['enabled'] = $this->enabled;
        }
        if ($this->integration_id !== OptionalValue::Missing) {
            $data['integration_id'] = $this->integration_id === null ? null : $this->integration_id;
        }
        if ($this->name !== OptionalValue::Missing) {
            $data['name'] = $this->name;
        }
        if ($this->type !== OptionalValue::Missing) {
            $data['type'] = $this->type->value;
        }
        if ($this->webhook_secret !== OptionalValue::Missing) {
            $data['webhook_secret'] = $this->webhook_secret === null ? null : $this->webhook_secret;
        }

        return $data;
    }
}
