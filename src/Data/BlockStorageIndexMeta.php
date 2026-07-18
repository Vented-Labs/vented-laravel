<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BlockStorageIndexMeta
{
    public function __construct(
        public string $catalog_status,
        public BlockStorageIndexMetaFormOptions $form_options,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            catalog_status: (string) $data['catalog_status'],
            form_options: BlockStorageIndexMetaFormOptions::fromArray(self::objectValue($data['form_options'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['catalog_status'] = $this->catalog_status;
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
