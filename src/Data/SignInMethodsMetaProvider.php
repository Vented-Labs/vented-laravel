<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SignInMethodsMetaProvider
{
    public function __construct(
        public bool $can_disconnect,
        public bool $connected,
        public ?string $email,
        public string $label,
        public string $provider,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_disconnect: (bool) $data['can_disconnect'],
            connected: (bool) $data['connected'],
            email: $data['email'] === null ? null : (string) $data['email'],
            label: (string) $data['label'],
            provider: (string) $data['provider'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_disconnect'] = $this->can_disconnect;
        $data['connected'] = $this->connected;
        $data['email'] = $this->email === null ? null : $this->email;
        $data['label'] = $this->label;
        $data['provider'] = $this->provider;

        return $data;
    }
}
