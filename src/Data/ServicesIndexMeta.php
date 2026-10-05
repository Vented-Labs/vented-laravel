<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ServicesIndexMeta
{
    public function __construct(
        public bool $can_update,
        public ServicesIndexMetaFormOptions $form_options,
        public string $location_id,
        public ?string $location_name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_update: (bool) $data['can_update'],
            form_options: ServicesIndexMetaFormOptions::fromArray(self::objectValue($data['form_options'])),
            location_id: (string) $data['location_id'],
            location_name: $data['location_name'] === null ? null : (string) $data['location_name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_update'] = $this->can_update;
        $data['form_options'] = $this->form_options->toArray();
        $data['location_id'] = $this->location_id;
        $data['location_name'] = $this->location_name === null ? null : $this->location_name;

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    private static function objectValue(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \InvalidArgumentException('Expected an object value.');
        }

        /** @var array<string, mixed> $value */
        return $value;
    }
}
