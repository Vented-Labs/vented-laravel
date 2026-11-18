<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class LiveSubscriptionData
{
    /**
     * @param  list<string>  $channels
     */
    public function __construct(
        public array $channels,
        public string $event,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            channels: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['channels'])),
            event: (string) $data['event'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['channels'] = $this->channels;
        $data['event'] = $this->event;

        return $data;
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
