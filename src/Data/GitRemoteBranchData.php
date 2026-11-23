<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class GitRemoteBranchData
{
    public function __construct(
        public string $name,
        public string $sha,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: (string) $data['name'],
            sha: (string) $data['sha'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['name'] = $this->name;
        $data['sha'] = $this->sha;

        return $data;
    }
}
