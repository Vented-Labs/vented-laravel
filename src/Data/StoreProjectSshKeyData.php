<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StoreProjectSshKeyData
{
    public function __construct(
        public string $ssh_key_id,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            ssh_key_id: (string) $data['ssh_key_id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['ssh_key_id'] = $this->ssh_key_id;

        return $data;
    }
}
