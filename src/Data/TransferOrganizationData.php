<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class TransferOrganizationData
{
    public function __construct(
        public string $member_id,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            member_id: (string) $data['member_id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['member_id'] = $this->member_id;

        return $data;
    }
}
