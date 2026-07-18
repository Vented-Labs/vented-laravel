<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BindingsIndexMeta
{
    public function __construct(
        public BindingsIndexMetaFormOptions $form_options,
        public BindingsViewer $viewer,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            form_options: BindingsIndexMetaFormOptions::fromArray(self::objectValue($data['form_options'])),
            viewer: BindingsViewer::fromArray(self::objectValue($data['viewer'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['form_options'] = $this->form_options->toArray();
        $data['viewer'] = $this->viewer->toArray();

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
