<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class CertificateBindingRef
{
    public function __construct(
        public string $hostname,
        public string $id,
        public string $zone_id,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            hostname: (string) $data['hostname'],
            id: (string) $data['id'],
            zone_id: (string) $data['zone_id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['hostname'] = $this->hostname;
        $data['id'] = $this->id;
        $data['zone_id'] = $this->zone_id;

        return $data;
    }
}
