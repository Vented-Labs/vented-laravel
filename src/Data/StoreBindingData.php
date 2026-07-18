<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\BindableType;

final readonly class StoreBindingData
{
    public function __construct(
        public string $target_id,
        public BindableType $target_type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            target_id: (string) $data['target_id'],
            target_type: BindableType::from((string) $data['target_type']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['target_id'] = $this->target_id;
        $data['target_type'] = $this->target_type->value;

        return $data;
    }
}
