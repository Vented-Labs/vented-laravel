<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\OptionalValue;

final readonly class AppLifecycleData
{
    public function __construct(
        public int|null|OptionalValue $expected_generation = OptionalValue::Missing,
        public string|null|OptionalValue $idempotency_key = OptionalValue::Missing,
        public bool|OptionalValue $resolve_only = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            expected_generation: array_key_exists('expected_generation', $data) ? $data['expected_generation'] === null ? null : (int) $data['expected_generation'] : OptionalValue::Missing,
            idempotency_key: array_key_exists('idempotency_key', $data) ? $data['idempotency_key'] === null ? null : (string) $data['idempotency_key'] : OptionalValue::Missing,
            resolve_only: array_key_exists('resolve_only', $data) ? (bool) $data['resolve_only'] : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->expected_generation !== OptionalValue::Missing) {
            $data['expected_generation'] = $this->expected_generation === null ? null : $this->expected_generation;
        }
        if ($this->idempotency_key !== OptionalValue::Missing) {
            $data['idempotency_key'] = $this->idempotency_key === null ? null : $this->idempotency_key;
        }
        if ($this->resolve_only !== OptionalValue::Missing) {
            $data['resolve_only'] = $this->resolve_only;
        }

        return $data;
    }
}
