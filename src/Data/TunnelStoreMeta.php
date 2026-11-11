<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class TunnelStoreMeta
{
    public function __construct(
        public string $credential,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            credential: (string) $data['credential'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['credential'] = $this->credential;

        return $data;
    }
}
