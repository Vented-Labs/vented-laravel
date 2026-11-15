<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BucketsIndexMeta
{
    /**
     * @param  list<ServiceMeterUsageData>  $usage
     */
    public function __construct(
        public bool $can_update,
        public ServicesIndexMetaFormOptions $form_options,
        public array $usage,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_update: (bool) $data['can_update'],
            form_options: ServicesIndexMetaFormOptions::fromArray(self::objectValue($data['form_options'])),
            usage: array_map(static fn (mixed $value): ServiceMeterUsageData => ServiceMeterUsageData::fromArray(self::objectValue($value)), self::listValue($data['usage'])),
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
        $data['usage'] = array_map(static fn (ServiceMeterUsageData $value) => $value->toArray(), $this->usage);

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
