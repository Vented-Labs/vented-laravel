<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class DeploysIndexMeta
{
    public function __construct(
        public DeploysIndexMetaFormOptions $form_options,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            form_options: DeploysIndexMetaFormOptions::fromArray(self::objectValue($data['form_options'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
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
