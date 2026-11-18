<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\DeployTriggerType;
use Vented\OptionalValue;

final readonly class StoreBuildTriggerData
{
    /**
     * @param  list<string>|null  $paths
     */
    public function __construct(
        public ?string $branch,
        public ?string $cron_expression,
        public string $name,
        public ?array $paths,
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
            branch: $data['branch'] === null ? null : (string) $data['branch'],
            cron_expression: $data['cron_expression'] === null ? null : (string) $data['cron_expression'],
            name: (string) $data['name'],
            paths: $data['paths'] === null ? null : array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['paths'])),
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
        $data['branch'] = $this->branch === null ? null : $this->branch;
        $data['cron_expression'] = $this->cron_expression === null ? null : $this->cron_expression;
        $data['name'] = $this->name;
        $data['paths'] = $this->paths === null ? null : $this->paths;
        $data['type'] = $this->type->value;
        $data['webhook_secret'] = $this->webhook_secret === null ? null : $this->webhook_secret;
        if ($this->enabled !== OptionalValue::Missing) {
            $data['enabled'] = $this->enabled;
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
