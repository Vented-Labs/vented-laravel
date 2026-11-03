<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppEventData
{
    /**
     * @param  array<string, mixed>  $details
     */
    public function __construct(
        public array $details,
        public string $id,
        public string $message,
        public string $occurred_at,
        public StatusData $severity,
        public string $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            details: self::objectValue($data['details']),
            id: (string) $data['id'],
            message: (string) $data['message'],
            occurred_at: (string) $data['occurred_at'],
            severity: StatusData::fromArray(self::objectValue($data['severity'])),
            type: (string) $data['type'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['details'] = $this->details;
        $data['id'] = $this->id;
        $data['message'] = $this->message;
        $data['occurred_at'] = $this->occurred_at;
        $data['severity'] = $this->severity->toArray();
        $data['type'] = $this->type;

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
