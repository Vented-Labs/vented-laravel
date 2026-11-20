<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AiAgentsIndexMeta
{
    /**
     * @param  list<AgentApprovalData>  $approvals
     * @param  list<array<string, mixed>>  $clients
     */
    public function __construct(
        public array $approvals,
        public array $clients,
        public string $server_url,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            approvals: array_map(static fn (mixed $value): AgentApprovalData => AgentApprovalData::fromArray(self::objectValue($value)), self::listValue($data['approvals'])),
            clients: array_map(static fn (mixed $value): array => self::objectValue($value), self::listValue($data['clients'])),
            server_url: (string) $data['server_url'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['approvals'] = array_map(static fn (AgentApprovalData $value) => $value->toArray(), $this->approvals);
        $data['clients'] = $this->clients;
        $data['server_url'] = $this->server_url;

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
