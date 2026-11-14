<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class RealtimeConfigData
{
    public function __construct(
        public string $host,
        public string $key,
        public int $port,
        public bool $tls,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            host: (string) $data['host'],
            key: (string) $data['key'],
            port: (int) $data['port'],
            tls: (bool) $data['tls'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['host'] = $this->host;
        $data['key'] = $this->key;
        $data['port'] = $this->port;
        $data['tls'] = $this->tls;

        return $data;
    }
}
