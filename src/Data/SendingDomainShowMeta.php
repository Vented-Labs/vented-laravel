<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SendingDomainShowMeta
{
    /**
     * @param  list<BindingData>  $bindings
     */
    public function __construct(
        public ?EmailActivityData $activity,
        public ?EmailAllowanceData $allowance,
        public array $bindings,
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
            activity: $data['activity'] === null ? null : EmailActivityData::fromArray(self::objectValue($data['activity'])),
            allowance: $data['allowance'] === null ? null : EmailAllowanceData::fromArray(self::objectValue($data['allowance'])),
            bindings: array_map(static fn (mixed $value): BindingData => BindingData::fromArray(self::objectValue($value)), self::listValue($data['bindings'])),
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
        $data['activity'] = $this->activity === null ? null : $this->activity->toArray();
        $data['allowance'] = $this->allowance === null ? null : $this->allowance->toArray();
        $data['bindings'] = array_map(static fn (BindingData $value) => $value->toArray(), $this->bindings);
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
