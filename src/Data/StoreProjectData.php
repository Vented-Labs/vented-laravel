<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\ProjectMarkColor;
use Vented\OptionalValue;

final readonly class StoreProjectData
{
    public function __construct(
        public string $location_id,
        public string $name,
        public ProjectMarkColor|null|OptionalValue $mark_color = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            location_id: (string) $data['location_id'],
            name: (string) $data['name'],
            mark_color: array_key_exists('mark_color', $data) ? $data['mark_color'] === null ? null : ProjectMarkColor::from((string) $data['mark_color']) : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['location_id'] = $this->location_id;
        $data['name'] = $this->name;
        if ($this->mark_color !== OptionalValue::Missing) {
            $data['mark_color'] = $this->mark_color === null ? null : $this->mark_color->value;
        }

        return $data;
    }
}
