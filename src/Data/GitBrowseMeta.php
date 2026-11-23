<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class GitBrowseMeta
{
    public function __construct(
        public ?string $next_cursor,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            next_cursor: $data['next_cursor'] === null ? null : (string) $data['next_cursor'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['next_cursor'] = $this->next_cursor === null ? null : $this->next_cursor;

        return $data;
    }
}
