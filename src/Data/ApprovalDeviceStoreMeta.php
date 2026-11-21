<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ApprovalDeviceStoreMeta
{
    public function __construct(
        public string $confirmation_code,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            confirmation_code: (string) $data['confirmation_code'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['confirmation_code'] = $this->confirmation_code;

        return $data;
    }
}
