<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BindingTlsActions
{
    public function __construct(
        public bool $replace_certificate,
        public bool $retry,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            replace_certificate: (bool) $data['replace_certificate'],
            retry: (bool) $data['retry'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['replace_certificate'] = $this->replace_certificate;
        $data['retry'] = $this->retry;

        return $data;
    }
}
