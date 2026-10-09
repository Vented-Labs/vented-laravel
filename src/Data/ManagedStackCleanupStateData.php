<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ManagedStackCleanupStateData
{
    public function __construct(
        public bool $can_retry,
        public string $id,
        public ?string $message,
        public StatusData $status,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_retry: (bool) $data['can_retry'],
            id: (string) $data['id'],
            message: $data['message'] === null ? null : (string) $data['message'],
            status: StatusData::fromArray(self::objectValue($data['status'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_retry'] = $this->can_retry;
        $data['id'] = $this->id;
        $data['message'] = $this->message === null ? null : $this->message;
        $data['status'] = $this->status->toArray();

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
