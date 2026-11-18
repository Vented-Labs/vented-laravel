<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\DeployTriggerType;
use Vented\OptionalValue;

final readonly class UpdateBuildTriggerData
{
    /**
     * @param  list<string>|null|OptionalValue  $paths
     */
    public function __construct(
        public string|null|OptionalValue $branch = OptionalValue::Missing,
        public string|null|OptionalValue $cron_expression = OptionalValue::Missing,
        public bool|OptionalValue $enabled = OptionalValue::Missing,
        public string|OptionalValue $name = OptionalValue::Missing,
        public array|null|OptionalValue $paths = OptionalValue::Missing,
        public DeployTriggerType|OptionalValue $type = OptionalValue::Missing,
        public string|null|OptionalValue $webhook_secret = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            branch: array_key_exists('branch', $data) ? $data['branch'] === null ? null : (string) $data['branch'] : OptionalValue::Missing,
            cron_expression: array_key_exists('cron_expression', $data) ? $data['cron_expression'] === null ? null : (string) $data['cron_expression'] : OptionalValue::Missing,
            enabled: array_key_exists('enabled', $data) ? (bool) $data['enabled'] : OptionalValue::Missing,
            name: array_key_exists('name', $data) ? (string) $data['name'] : OptionalValue::Missing,
            paths: array_key_exists('paths', $data) ? $data['paths'] === null ? null : array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['paths'])) : OptionalValue::Missing,
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
        if ($this->branch !== OptionalValue::Missing) {
            $data['branch'] = $this->branch === null ? null : $this->branch;
        }
        if ($this->cron_expression !== OptionalValue::Missing) {
            $data['cron_expression'] = $this->cron_expression === null ? null : $this->cron_expression;
        }
        if ($this->enabled !== OptionalValue::Missing) {
            $data['enabled'] = $this->enabled;
        }
        if ($this->name !== OptionalValue::Missing) {
            $data['name'] = $this->name;
        }
        if ($this->paths !== OptionalValue::Missing) {
            $data['paths'] = $this->paths === null ? null : $this->paths;
        }
        if ($this->type !== OptionalValue::Missing) {
            $data['type'] = $this->type->value;
        }
        if ($this->webhook_secret !== OptionalValue::Missing) {
            $data['webhook_secret'] = $this->webhook_secret === null ? null : $this->webhook_secret;
        }

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
