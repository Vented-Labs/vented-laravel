<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ApiTokenStoreMeta
{
    public function __construct(
        public string $plainTextToken,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            plainTextToken: (string) $data['plainTextToken'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['plainTextToken'] = $this->plainTextToken;

        return $data;
    }
}
