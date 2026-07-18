<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppBindingsForAppIndexMeta
{
    public function __construct(
        public ?FormOption $current_app,
        public AppBindingsForAppIndexMetaFormOptions $form_options,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            current_app: $data['current_app'] === null ? null : FormOption::fromArray(self::objectValue($data['current_app'])),
            form_options: AppBindingsForAppIndexMetaFormOptions::fromArray(self::objectValue($data['form_options'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['current_app'] = $this->current_app === null ? null : $this->current_app->toArray();
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
