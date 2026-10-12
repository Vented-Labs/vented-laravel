<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class GettingStartedStepData
{
    public function __construct(
        public bool $complete,
        public bool $create_project,
        public string $description,
        public string $key,
        public string $title,
        public ?string $url,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            complete: (bool) $data['complete'],
            create_project: (bool) $data['create_project'],
            description: (string) $data['description'],
            key: (string) $data['key'],
            title: (string) $data['title'],
            url: $data['url'] === null ? null : (string) $data['url'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['complete'] = $this->complete;
        $data['create_project'] = $this->create_project;
        $data['description'] = $this->description;
        $data['key'] = $this->key;
        $data['title'] = $this->title;
        $data['url'] = $this->url === null ? null : $this->url;

        return $data;
    }
}
