<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class TunnelAgentSetupData
{
    public function __construct(
        public string $certificate,
        public string $certificate_fingerprint,
        public string $connect_host,
        public string $connect_path,
        public int $connect_port,
        public string $credential_meta,
        public int $heartbeat_timeout,
        public string $id,
        public string $protocol,
        public string $server_name,
        public string $token,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            certificate: (string) $data['certificate'],
            certificate_fingerprint: (string) $data['certificate_fingerprint'],
            connect_host: (string) $data['connect_host'],
            connect_path: (string) $data['connect_path'],
            connect_port: (int) $data['connect_port'],
            credential_meta: (string) $data['credential_meta'],
            heartbeat_timeout: (int) $data['heartbeat_timeout'],
            id: (string) $data['id'],
            protocol: (string) $data['protocol'],
            server_name: (string) $data['server_name'],
            token: (string) $data['token'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['certificate'] = $this->certificate;
        $data['certificate_fingerprint'] = $this->certificate_fingerprint;
        $data['connect_host'] = $this->connect_host;
        $data['connect_path'] = $this->connect_path;
        $data['connect_port'] = $this->connect_port;
        $data['credential_meta'] = $this->credential_meta;
        $data['heartbeat_timeout'] = $this->heartbeat_timeout;
        $data['id'] = $this->id;
        $data['protocol'] = $this->protocol;
        $data['server_name'] = $this->server_name;
        $data['token'] = $this->token;

        return $data;
    }
}
