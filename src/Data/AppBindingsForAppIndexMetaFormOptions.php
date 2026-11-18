<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppBindingsForAppIndexMetaFormOptions
{
    /**
     * @param  list<CertificateOption>  $certificates
     * @param  list<FormOption>  $port_types
     * @param  list<FormOption>  $tls_modes
     * @param  list<FormOption>  $zones
     */
    public function __construct(
        public array $certificates,
        public array $port_types,
        public array $tls_modes,
        public array $zones,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            certificates: array_map(static fn (mixed $value): CertificateOption => CertificateOption::fromArray(self::objectValue($value)), self::listValue($data['certificates'])),
            port_types: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['port_types'])),
            tls_modes: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['tls_modes'])),
            zones: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['zones'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['certificates'] = array_map(static fn (CertificateOption $value) => $value->toArray(), $this->certificates);
        $data['port_types'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->port_types);
        $data['tls_modes'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->tls_modes);
        $data['zones'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->zones);

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
