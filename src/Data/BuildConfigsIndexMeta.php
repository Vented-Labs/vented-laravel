<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BuildConfigsIndexMeta
{
    /**
     * @param  list<BuildGroupData>  $groups
     */
    public function __construct(
        public ?FormOption $current_app,
        public BuildConfigFormOptions $form_options,
        public array $groups,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            current_app: $data['current_app'] === null ? null : FormOption::fromArray(self::objectValue($data['current_app'])),
            form_options: BuildConfigFormOptions::fromArray(self::objectValue($data['form_options'])),
            groups: array_map(static fn (mixed $value): BuildGroupData => BuildGroupData::fromArray(self::objectValue($value)), self::listValue($data['groups'])),
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
        $data['groups'] = array_map(static fn (BuildGroupData $value) => $value->toArray(), $this->groups);

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
