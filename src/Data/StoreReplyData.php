<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StoreReplyData
{
    public function __construct(
        public string $body,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            body: (string) $data['body'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['body'] = $this->body;

        return $data;
    }
}
