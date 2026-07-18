<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppBindingsIndexMeta
{
    /**
     * @param  list<AppBindingMeta>  $bindings
     */
    public function __construct(
        public array $bindings,
        public AppBindingsIndexMetaFormOptions $form_options,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            bindings: array_map(static fn (mixed $value): AppBindingMeta => AppBindingMeta::fromArray(self::objectValue($value)), self::listValue($data['bindings'])),
            form_options: AppBindingsIndexMetaFormOptions::fromArray(self::objectValue($data['form_options'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['bindings'] = array_map(static fn (AppBindingMeta $value) => $value->toArray(), $this->bindings);
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

    /**
     * @return list<mixed>
     */
    private static function listValue(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \InvalidArgumentException('Expected an array value.');
        }

        return array_values($value);
    }
}
