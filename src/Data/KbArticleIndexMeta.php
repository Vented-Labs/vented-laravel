<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class KbArticleIndexMeta
{
    public function __construct(
        public string $query,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            query: (string) $data['query'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['query'] = $this->query;

        return $data;
    }
}
