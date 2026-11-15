<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BucketShowMeta
{
    public function __construct(
        public bool $can_update,
        public ServiceLiveData $live,
        public bool $rejected,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_update: (bool) $data['can_update'],
            live: ServiceLiveData::fromArray(self::objectValue($data['live'])),
            rejected: (bool) $data['rejected'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_update'] = $this->can_update;
        $data['live'] = $this->live->toArray();
        $data['rejected'] = $this->rejected;

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
