<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class JsonApiErrorSource
{
    public function __construct(
        public string $pointer,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            pointer: (string) $data['pointer'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['pointer'] = $this->pointer;

        return $data;
    }
}
