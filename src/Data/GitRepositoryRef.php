<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\GitProvider;

final readonly class GitRepositoryRef
{
    public function __construct(
        public ?string $external_id,
        public string $full_name,
        public ?string $git_connection_id,
        public string $id,
        public GitProvider $provider,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            external_id: $data['external_id'] === null ? null : (string) $data['external_id'],
            full_name: (string) $data['full_name'],
            git_connection_id: $data['git_connection_id'] === null ? null : (string) $data['git_connection_id'],
            id: (string) $data['id'],
            provider: GitProvider::from((string) $data['provider']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['external_id'] = $this->external_id === null ? null : $this->external_id;
        $data['full_name'] = $this->full_name;
        $data['git_connection_id'] = $this->git_connection_id === null ? null : $this->git_connection_id;
        $data['id'] = $this->id;
        $data['provider'] = $this->provider->value;

        return $data;
    }
}
