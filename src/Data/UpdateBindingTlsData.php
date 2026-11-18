<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\TlsMode;

final readonly class UpdateBindingTlsData
{
    public function __construct(
        public ?string $certificate_id,
        public TlsMode $mode,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            certificate_id: $data['certificate_id'] === null ? null : (string) $data['certificate_id'],
            mode: TlsMode::from((string) $data['mode']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['certificate_id'] = $this->certificate_id === null ? null : $this->certificate_id;
        $data['mode'] = $this->mode->value;

        return $data;
    }
}
