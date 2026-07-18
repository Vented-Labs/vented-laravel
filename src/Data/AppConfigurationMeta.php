<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppConfigurationMeta
{
    /**
     * @param  array<string, mixed>  $current_configuration
     */
    public function __construct(
        public array $current_configuration,
        public AppConfigurationMetaFormOptions $form_options,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            current_configuration: self::objectValue($data['current_configuration']),
            form_options: AppConfigurationMetaFormOptions::fromArray(self::objectValue($data['form_options'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['current_configuration'] = $this->current_configuration;
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
