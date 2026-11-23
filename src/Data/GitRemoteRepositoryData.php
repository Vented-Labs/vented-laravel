<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class GitRemoteRepositoryData
{
    public function __construct(
        public string $default_branch,
        public string $full_name,
        public string $id,
        public bool $private,
        public string $web_url,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            default_branch: (string) $data['default_branch'],
            full_name: (string) $data['full_name'],
            id: (string) $data['id'],
            private: (bool) $data['private'],
            web_url: (string) $data['web_url'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['default_branch'] = $this->default_branch;
        $data['full_name'] = $this->full_name;
        $data['id'] = $this->id;
        $data['private'] = $this->private;
        $data['web_url'] = $this->web_url;

        return $data;
    }
}
