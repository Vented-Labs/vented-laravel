<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class UpdateBindingPurposeData
{
    public function __construct(
        public ?string $purpose,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            purpose: $data['purpose'] === null ? null : (string) $data['purpose'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['purpose'] = $this->purpose === null ? null : $this->purpose;

        return $data;
    }
}
