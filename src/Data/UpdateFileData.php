<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\OptionalValue;

final readonly class UpdateFileData
{
    public function __construct(
        public string $path,
        public bool|OptionalValue $overwrite = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            path: (string) $data['path'],
            overwrite: array_key_exists('overwrite', $data) ? (bool) $data['overwrite'] : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['path'] = $this->path;
        if ($this->overwrite !== OptionalValue::Missing) {
            $data['overwrite'] = $this->overwrite;
        }

        return $data;
    }
}
