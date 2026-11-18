<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class CertificateShowMeta
{
    /**
     * @param  list<CertificateDomainData>  $domains
     * @param  list<FormOption>  $tls_modes
     */
    public function __construct(
        public array $domains,
        public array $tls_modes,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            domains: array_map(static fn (mixed $value): CertificateDomainData => CertificateDomainData::fromArray(self::objectValue($value)), self::listValue($data['domains'])),
            tls_modes: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['tls_modes'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['domains'] = array_map(static fn (CertificateDomainData $value) => $value->toArray(), $this->domains);
        $data['tls_modes'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->tls_modes);

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
