<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class TunnelsAvailabilityData
{
    public function __construct(
        public TunnelAvailabilityData $private,
        public TunnelAvailabilityData $public,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            private: TunnelAvailabilityData::fromArray(self::objectValue($data['private'])),
            public: TunnelAvailabilityData::fromArray(self::objectValue($data['public'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['private'] = $this->private->toArray();
        $data['public'] = $this->public->toArray();

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
