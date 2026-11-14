<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class NotificationsIndexMeta
{
    public function __construct(
        public int $unread,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            unread: (int) $data['unread'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['unread'] = $this->unread;

        return $data;
    }
}
