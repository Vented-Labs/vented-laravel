<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class DeployTriggerConfigData
{
    /**
     * @param  list<string>  $paths
     */
    public function __construct(
        public ?string $branch,
        public ?string $cron_expression,
        public array $paths,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            branch: $data['branch'] === null ? null : (string) $data['branch'],
            cron_expression: $data['cron_expression'] === null ? null : (string) $data['cron_expression'],
            paths: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['paths'])),
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
        $data['paths'] = $this->paths;

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
