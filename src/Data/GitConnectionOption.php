<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class GitConnectionOption
{
    public function __construct(
        public string $host,
        public string $icon,
        public string $label,
        public bool $lists_branches,
        public bool $lists_repositories,
        public string $provider,
        public string $value,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            host: (string) $data['host'],
            icon: (string) $data['icon'],
            label: (string) $data['label'],
            lists_branches: (bool) $data['lists_branches'],
            lists_repositories: (bool) $data['lists_repositories'],
            provider: (string) $data['provider'],
            value: (string) $data['value'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['host'] = $this->host;
        $data['icon'] = $this->icon;
        $data['label'] = $this->label;
        $data['lists_branches'] = $this->lists_branches;
        $data['lists_repositories'] = $this->lists_repositories;
        $data['provider'] = $this->provider;
        $data['value'] = $this->value;

        return $data;
    }
}
