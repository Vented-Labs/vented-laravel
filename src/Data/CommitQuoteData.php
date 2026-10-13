<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class CommitQuoteData
{
    public function __construct(
        public string $operation_key,
        public string $quote_id,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            operation_key: (string) $data['operation_key'],
            quote_id: (string) $data['quote_id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['operation_key'] = $this->operation_key;
        $data['quote_id'] = $this->quote_id;

        return $data;
    }
}
