<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SearchIndexMeta
{
    public function __construct(
        public bool $kb_query_failed,
        public string $query,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            kb_query_failed: (bool) $data['kb_query_failed'],
            query: (string) $data['query'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['kb_query_failed'] = $this->kb_query_failed;
        $data['query'] = $this->query;

        return $data;
    }
}
