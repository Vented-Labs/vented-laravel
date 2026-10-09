<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ManagedStacksIndexMeta
{
    public function __construct(
        public bool $can_update,
        public ?string $catalog_error,
        public ManagedStacksFormOptions $form_options,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_update: (bool) $data['can_update'],
            catalog_error: $data['catalog_error'] === null ? null : (string) $data['catalog_error'],
            form_options: ManagedStacksFormOptions::fromArray(self::objectValue($data['form_options'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_update'] = $this->can_update;
        $data['catalog_error'] = $this->catalog_error === null ? null : $this->catalog_error;
        $data['form_options'] = $this->form_options->toArray();

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
