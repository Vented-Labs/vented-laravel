<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ApprovalDecisionData
{
    public function __construct(
        public string $approval,
        public string $decision,
        public string $signature,
        public int $signed_at,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            approval: (string) $data['approval'],
            decision: (string) $data['decision'],
            signature: (string) $data['signature'],
            signed_at: (int) $data['signed_at'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['approval'] = $this->approval;
        $data['decision'] = $this->decision;
        $data['signature'] = $this->signature;
        $data['signed_at'] = $this->signed_at;

        return $data;
    }
}
