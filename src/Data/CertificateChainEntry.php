<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class CertificateChainEntry
{
    public function __construct(
        public ?string $issuer,
        public string $not_after,
        public ?string $subject,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            issuer: $data['issuer'] === null ? null : (string) $data['issuer'],
            not_after: (string) $data['not_after'],
            subject: $data['subject'] === null ? null : (string) $data['subject'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['issuer'] = $this->issuer === null ? null : $this->issuer;
        $data['not_after'] = $this->not_after;
        $data['subject'] = $this->subject === null ? null : $this->subject;

        return $data;
    }
}
