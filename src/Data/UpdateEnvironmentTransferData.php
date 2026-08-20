<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\EnvironmentTransferSecretPolicy;
use Vented\OptionalValue;

final readonly class UpdateEnvironmentTransferData
{
    /**
     * @param  list<UpdateEnvironmentTransferDecisionData>|OptionalValue  $decisions
     */
    public function __construct(
        public string $manifest_revision,
        public array|OptionalValue $decisions = OptionalValue::Missing,
        public bool|OptionalValue $production_confirmed = OptionalValue::Missing,
        public EnvironmentTransferSecretPolicy|OptionalValue $secret_policy = OptionalValue::Missing,
        public string|OptionalValue $status = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            manifest_revision: (string) $data['manifest_revision'],
            decisions: array_key_exists('decisions', $data) ? array_map(static fn (mixed $value): UpdateEnvironmentTransferDecisionData => UpdateEnvironmentTransferDecisionData::fromArray(self::objectValue($value)), self::listValue($data['decisions'])) : OptionalValue::Missing,
            production_confirmed: array_key_exists('production_confirmed', $data) ? (bool) $data['production_confirmed'] : OptionalValue::Missing,
            secret_policy: array_key_exists('secret_policy', $data) ? EnvironmentTransferSecretPolicy::from((string) $data['secret_policy']) : OptionalValue::Missing,
            status: array_key_exists('status', $data) ? (string) $data['status'] : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['manifest_revision'] = $this->manifest_revision;
        if ($this->decisions !== OptionalValue::Missing) {
            $data['decisions'] = array_map(static fn (UpdateEnvironmentTransferDecisionData $value) => $value->toArray(), $this->decisions);
        }
        if ($this->production_confirmed !== OptionalValue::Missing) {
            $data['production_confirmed'] = $this->production_confirmed;
        }
        if ($this->secret_policy !== OptionalValue::Missing) {
            $data['secret_policy'] = $this->secret_policy->value;
        }
        if ($this->status !== OptionalValue::Missing) {
            $data['status'] = $this->status;
        }

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
