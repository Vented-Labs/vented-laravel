<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SupportOverviewData
{
    public function __construct(
        public int $awaiting_reply_count,
        public string $id,
        public int $open_count,
        public int $pending_count,
        public int $resolved_count,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            awaiting_reply_count: (int) $data['awaiting_reply_count'],
            id: (string) $data['id'],
            open_count: (int) $data['open_count'],
            pending_count: (int) $data['pending_count'],
            resolved_count: (int) $data['resolved_count'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['awaiting_reply_count'] = $this->awaiting_reply_count;
        $data['id'] = $this->id;
        $data['open_count'] = $this->open_count;
        $data['pending_count'] = $this->pending_count;
        $data['resolved_count'] = $this->resolved_count;

        return $data;
    }
}
