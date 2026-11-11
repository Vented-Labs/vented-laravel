<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class TunnelsIndexMeta
{
    public function __construct(
        public TunnelAllowanceData $allowance,
        public TunnelsAvailabilityData $availability,
        public bool $can_update,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            allowance: TunnelAllowanceData::fromArray(self::objectValue($data['allowance'])),
            availability: TunnelsAvailabilityData::fromArray(self::objectValue($data['availability'])),
            can_update: (bool) $data['can_update'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['allowance'] = $this->allowance->toArray();
        $data['availability'] = $this->availability->toArray();
        $data['can_update'] = $this->can_update;

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
