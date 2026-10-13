<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BindPaymentMethodData
{
    public function __construct(
        public string $operation_key,
        public string $setup_intent_id,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            operation_key: (string) $data['operation_key'],
            setup_intent_id: (string) $data['setup_intent_id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['operation_key'] = $this->operation_key;
        $data['setup_intent_id'] = $this->setup_intent_id;

        return $data;
    }
}
