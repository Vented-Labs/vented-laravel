<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class S3ProviderOption
{
    /**
     * @param  array<string, mixed>  $regionEndpoints
     * @param  list<FormOption>  $regions
     */
    public function __construct(
        public ?string $accountLabel,
        public bool $choosesAddressing,
        public bool $createsBuckets,
        public ?string $credentialsNote,
        public bool $customEndpoint,
        public ?string $endpointTemplate,
        public ?string $icon,
        public string $label,
        public array $regionEndpoints,
        public array $regions,
        public string $value,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            accountLabel: $data['accountLabel'] === null ? null : (string) $data['accountLabel'],
            choosesAddressing: (bool) $data['choosesAddressing'],
            createsBuckets: (bool) $data['createsBuckets'],
            credentialsNote: $data['credentialsNote'] === null ? null : (string) $data['credentialsNote'],
            customEndpoint: (bool) $data['customEndpoint'],
            endpointTemplate: $data['endpointTemplate'] === null ? null : (string) $data['endpointTemplate'],
            icon: $data['icon'] === null ? null : (string) $data['icon'],
            label: (string) $data['label'],
            regionEndpoints: self::objectValue($data['regionEndpoints']),
            regions: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['regions'])),
            value: (string) $data['value'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['accountLabel'] = $this->accountLabel === null ? null : $this->accountLabel;
        $data['choosesAddressing'] = $this->choosesAddressing;
        $data['createsBuckets'] = $this->createsBuckets;
        $data['credentialsNote'] = $this->credentialsNote === null ? null : $this->credentialsNote;
        $data['customEndpoint'] = $this->customEndpoint;
        $data['endpointTemplate'] = $this->endpointTemplate === null ? null : $this->endpointTemplate;
        $data['icon'] = $this->icon === null ? null : $this->icon;
        $data['label'] = $this->label;
        $data['regionEndpoints'] = $this->regionEndpoints;
        $data['regions'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->regions);
        $data['value'] = $this->value;

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
