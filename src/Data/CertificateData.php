<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\StatusTone;

final readonly class CertificateData
{
    /**
     * @param  list<CertificateBindingRef>  $bindings
     * @param  list<CertificateChainEntry>  $chain
     * @param  list<string>  $names
     */
    public function __construct(
        public array $bindings,
        public array $chain,
        public ?string $common_name,
        public string $created_at,
        public bool $expired,
        public ?string $expiry_notice,
        public StatusTone $expiry_tone,
        public string $fingerprint,
        public string $id,
        public ?string $issuer,
        public ?string $issuer_common_name,
        public ?string $issuer_organization,
        public ?int $key_bits,
        public string $key_type,
        public string $name,
        public array $names,
        public string $not_after,
        public string $not_before,
        public bool $private_key_set,
        public bool $publicly_trusted,
        public ?string $serial_number,
        public ?string $signature_algorithm,
        public ?string $subject_organization,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            bindings: array_map(static fn (mixed $value): CertificateBindingRef => CertificateBindingRef::fromArray(self::objectValue($value)), self::listValue($data['bindings'])),
            chain: array_map(static fn (mixed $value): CertificateChainEntry => CertificateChainEntry::fromArray(self::objectValue($value)), self::listValue($data['chain'])),
            common_name: $data['common_name'] === null ? null : (string) $data['common_name'],
            created_at: (string) $data['created_at'],
            expired: (bool) $data['expired'],
            expiry_notice: $data['expiry_notice'] === null ? null : (string) $data['expiry_notice'],
            expiry_tone: StatusTone::from((string) $data['expiry_tone']),
            fingerprint: (string) $data['fingerprint'],
            id: (string) $data['id'],
            issuer: $data['issuer'] === null ? null : (string) $data['issuer'],
            issuer_common_name: $data['issuer_common_name'] === null ? null : (string) $data['issuer_common_name'],
            issuer_organization: $data['issuer_organization'] === null ? null : (string) $data['issuer_organization'],
            key_bits: $data['key_bits'] === null ? null : (int) $data['key_bits'],
            key_type: (string) $data['key_type'],
            name: (string) $data['name'],
            names: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['names'])),
            not_after: (string) $data['not_after'],
            not_before: (string) $data['not_before'],
            private_key_set: (bool) $data['private_key_set'],
            publicly_trusted: (bool) $data['publicly_trusted'],
            serial_number: $data['serial_number'] === null ? null : (string) $data['serial_number'],
            signature_algorithm: $data['signature_algorithm'] === null ? null : (string) $data['signature_algorithm'],
            subject_organization: $data['subject_organization'] === null ? null : (string) $data['subject_organization'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['bindings'] = array_map(static fn (CertificateBindingRef $value) => $value->toArray(), $this->bindings);
        $data['chain'] = array_map(static fn (CertificateChainEntry $value) => $value->toArray(), $this->chain);
        $data['common_name'] = $this->common_name === null ? null : $this->common_name;
        $data['created_at'] = $this->created_at;
        $data['expired'] = $this->expired;
        $data['expiry_notice'] = $this->expiry_notice === null ? null : $this->expiry_notice;
        $data['expiry_tone'] = $this->expiry_tone->value;
        $data['fingerprint'] = $this->fingerprint;
        $data['id'] = $this->id;
        $data['issuer'] = $this->issuer === null ? null : $this->issuer;
        $data['issuer_common_name'] = $this->issuer_common_name === null ? null : $this->issuer_common_name;
        $data['issuer_organization'] = $this->issuer_organization === null ? null : $this->issuer_organization;
        $data['key_bits'] = $this->key_bits === null ? null : $this->key_bits;
        $data['key_type'] = $this->key_type;
        $data['name'] = $this->name;
        $data['names'] = $this->names;
        $data['not_after'] = $this->not_after;
        $data['not_before'] = $this->not_before;
        $data['private_key_set'] = $this->private_key_set;
        $data['publicly_trusted'] = $this->publicly_trusted;
        $data['serial_number'] = $this->serial_number === null ? null : $this->serial_number;
        $data['signature_algorithm'] = $this->signature_algorithm === null ? null : $this->signature_algorithm;
        $data['subject_organization'] = $this->subject_organization === null ? null : $this->subject_organization;

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
