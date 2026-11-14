<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class KbArticleData
{
    public function __construct(
        public ?string $author_name,
        public string $content_html,
        public string $created_at,
        public ?string $description,
        public string $id,
        public ?string $published_at,
        public string $slug,
        public string $title,
        public string $updated_at,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            author_name: $data['author_name'] === null ? null : (string) $data['author_name'],
            content_html: (string) $data['content_html'],
            created_at: (string) $data['created_at'],
            description: $data['description'] === null ? null : (string) $data['description'],
            id: (string) $data['id'],
            published_at: $data['published_at'] === null ? null : (string) $data['published_at'],
            slug: (string) $data['slug'],
            title: (string) $data['title'],
            updated_at: (string) $data['updated_at'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['author_name'] = $this->author_name === null ? null : $this->author_name;
        $data['content_html'] = $this->content_html;
        $data['created_at'] = $this->created_at;
        $data['description'] = $this->description === null ? null : $this->description;
        $data['id'] = $this->id;
        $data['published_at'] = $this->published_at === null ? null : $this->published_at;
        $data['slug'] = $this->slug;
        $data['title'] = $this->title;
        $data['updated_at'] = $this->updated_at;

        return $data;
    }
}
