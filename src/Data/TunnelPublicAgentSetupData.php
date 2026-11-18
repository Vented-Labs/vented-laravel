<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class TunnelPublicAgentSetupData
{
    /**
     * @param  list<string>  $hostnames
     */
    public function __construct(
        public string $access,
        public string $connect_host,
        public string $connect_path,
        public int $connect_port,
        public array $hostnames,
        public string $id,
        public string $protocol,
        public string $token,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            access: (string) $data['access'],
            connect_host: (string) $data['connect_host'],
            connect_path: (string) $data['connect_path'],
            connect_port: (int) $data['connect_port'],
            hostnames: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['hostnames'])),
            id: (string) $data['id'],
            protocol: (string) $data['protocol'],
            token: (string) $data['token'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['access'] = $this->access;
        $data['connect_host'] = $this->connect_host;
        $data['connect_path'] = $this->connect_path;
        $data['connect_port'] = $this->connect_port;
        $data['hostnames'] = $this->hostnames;
        $data['id'] = $this->id;
        $data['protocol'] = $this->protocol;
        $data['token'] = $this->token;

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
