<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\SearchableType;

final readonly class ProjectHitData
{
    public function __construct(
        public ?string $environment_id,
        public string $icon,
        public SearchableType $kind,
        public string $project_name,
        public ?string $subtitle,
        public string $title,
        public string $url,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            environment_id: $data['environment_id'] === null ? null : (string) $data['environment_id'],
            icon: (string) $data['icon'],
            kind: SearchableType::from((string) $data['kind']),
            project_name: (string) $data['project_name'],
            subtitle: $data['subtitle'] === null ? null : (string) $data['subtitle'],
            title: (string) $data['title'],
            url: (string) $data['url'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['environment_id'] = $this->environment_id === null ? null : $this->environment_id;
        $data['icon'] = $this->icon;
        $data['kind'] = $this->kind->value;
        $data['project_name'] = $this->project_name;
        $data['subtitle'] = $this->subtitle === null ? null : $this->subtitle;
        $data['title'] = $this->title;
        $data['url'] = $this->url;

        return $data;
    }
}
