<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppConfigurationMeta
{
    /**
     * @param  list<string>  $configured_secrets
     * @param  array<string, mixed>  $current_configuration
     * @param  array<string, mixed>  $option_providers
     * @param  list<array<string, mixed>>|null  $origins
     */
    public function __construct(
        public array $configured_secrets,
        public array $current_configuration,
        public AppConfigurationMetaFormOptions $form_options,
        public array $option_providers,
        public ?array $origins,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            configured_secrets: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['configured_secrets'])),
            current_configuration: self::objectValue($data['current_configuration']),
            form_options: AppConfigurationMetaFormOptions::fromArray(self::objectValue($data['form_options'])),
            option_providers: self::objectValue($data['option_providers']),
            origins: $data['origins'] === null ? null : array_map(static fn (mixed $value): array => self::objectValue($value), self::listValue($data['origins'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['configured_secrets'] = $this->configured_secrets;
        $data['current_configuration'] = $this->current_configuration;
        $data['form_options'] = $this->form_options->toArray();
        $data['option_providers'] = $this->option_providers;
        $data['origins'] = $this->origins === null ? null : $this->origins;

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
