<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StackOptionAvailabilityData
{
    public function __construct(
        public ?string $issue,
        public bool $link,
        public bool $provision,
        public ?string $reason,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            issue: $data['issue'] === null ? null : (string) $data['issue'],
            link: (bool) $data['link'],
            provision: (bool) $data['provision'],
            reason: $data['reason'] === null ? null : (string) $data['reason'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['issue'] = $this->issue === null ? null : $this->issue;
        $data['link'] = $this->link;
        $data['provision'] = $this->provision;
        $data['reason'] = $this->reason === null ? null : $this->reason;

        return $data;
    }
}
