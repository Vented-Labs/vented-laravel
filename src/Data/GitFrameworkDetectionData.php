<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\BuildPreset;

final readonly class GitFrameworkDetectionData
{
    public function __construct(
        public string $id,
        public ?BuildPreset $preset,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) $data['id'],
            preset: $data['preset'] === null ? null : BuildPreset::from((string) $data['preset']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = $this->id;
        $data['preset'] = $this->preset === null ? null : $this->preset->value;

        return $data;
    }
}
