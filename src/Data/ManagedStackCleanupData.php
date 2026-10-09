<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ManagedStackCleanupData
{
    public function __construct(
        public string $id,
        public StatusData $status,
        public int $target_count,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) $data['id'],
            status: StatusData::fromArray(self::objectValue($data['status'])),
            target_count: (int) $data['target_count'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = $this->id;
        $data['status'] = $this->status->toArray();
        $data['target_count'] = $this->target_count;

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
