<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StackRelationshipData
{
    public function __construct(
        public string $from_role,
        public bool $if_present,
        public string $kind,
        public ?string $mount_point,
        public ?string $purpose,
        public string $to_role,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            from_role: (string) $data['from_role'],
            if_present: (bool) $data['if_present'],
            kind: (string) $data['kind'],
            mount_point: $data['mount_point'] === null ? null : (string) $data['mount_point'],
            purpose: $data['purpose'] === null ? null : (string) $data['purpose'],
            to_role: (string) $data['to_role'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['from_role'] = $this->from_role;
        $data['if_present'] = $this->if_present;
        $data['kind'] = $this->kind;
        $data['mount_point'] = $this->mount_point === null ? null : $this->mount_point;
        $data['purpose'] = $this->purpose === null ? null : $this->purpose;
        $data['to_role'] = $this->to_role;

        return $data;
    }
}
