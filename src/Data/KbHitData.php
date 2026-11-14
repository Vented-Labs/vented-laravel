<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class KbHitData
{
    public function __construct(
        public ?string $excerpt,
        public string $slug,
        public string $title,
        public string $url,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            excerpt: $data['excerpt'] === null ? null : (string) $data['excerpt'],
            slug: (string) $data['slug'],
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
        $data['excerpt'] = $this->excerpt === null ? null : $this->excerpt;
        $data['slug'] = $this->slug;
        $data['title'] = $this->title;
        $data['url'] = $this->url;

        return $data;
    }
}
