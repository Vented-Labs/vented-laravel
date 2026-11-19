<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ApiTokensIndexMeta
{
    /**
     * @param  list<FormOption>  $accesses
     * @param  list<ApiTokenScopeGroupData>  $permission_groups
     * @param  list<ApiTokenReachableOrganizationData>  $reachable
     */
    public function __construct(
        public array $accesses,
        public ApiTokenExpiryData $expiry,
        public array $permission_groups,
        public array $reachable,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            accesses: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['accesses'])),
            expiry: ApiTokenExpiryData::fromArray(self::objectValue($data['expiry'])),
            permission_groups: array_map(static fn (mixed $value): ApiTokenScopeGroupData => ApiTokenScopeGroupData::fromArray(self::objectValue($value)), self::listValue($data['permission_groups'])),
            reachable: array_map(static fn (mixed $value): ApiTokenReachableOrganizationData => ApiTokenReachableOrganizationData::fromArray(self::objectValue($value)), self::listValue($data['reachable'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['accesses'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->accesses);
        $data['expiry'] = $this->expiry->toArray();
        $data['permission_groups'] = array_map(static fn (ApiTokenScopeGroupData $value) => $value->toArray(), $this->permission_groups);
        $data['reachable'] = array_map(static fn (ApiTokenReachableOrganizationData $value) => $value->toArray(), $this->reachable);

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
