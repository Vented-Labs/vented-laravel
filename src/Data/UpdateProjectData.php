<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\OptionalValue;

final readonly class UpdateProjectData
{
    public function __construct(
        public string|OptionalValue $owner_id = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            owner_id: array_key_exists('owner_id', $data) ? (string) $data['owner_id'] : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->owner_id !== OptionalValue::Missing) {
            $data['owner_id'] = $this->owner_id;
        }

        return $data;
    }
}
