<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class EmailActivityData
{
    /**
     * @param  list<EmailActivityAppData>  $apps
     * @param  list<EmailActivityDayData>  $daily
     * @param  list<EmailMessageData>  $recent
     */
    public function __construct(
        public array $apps,
        public bool $available,
        public array $daily,
        public int $days,
        public int $delivered,
        public int $emails,
        public int $failed,
        public array $recent,
        public int $refused,
        public int $retrying,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            apps: array_map(static fn (mixed $value): EmailActivityAppData => EmailActivityAppData::fromArray(self::objectValue($value)), self::listValue($data['apps'])),
            available: (bool) $data['available'],
            daily: array_map(static fn (mixed $value): EmailActivityDayData => EmailActivityDayData::fromArray(self::objectValue($value)), self::listValue($data['daily'])),
            days: (int) $data['days'],
            delivered: (int) $data['delivered'],
            emails: (int) $data['emails'],
            failed: (int) $data['failed'],
            recent: array_map(static fn (mixed $value): EmailMessageData => EmailMessageData::fromArray(self::objectValue($value)), self::listValue($data['recent'])),
            refused: (int) $data['refused'],
            retrying: (int) $data['retrying'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['apps'] = array_map(static fn (EmailActivityAppData $value) => $value->toArray(), $this->apps);
        $data['available'] = $this->available;
        $data['daily'] = array_map(static fn (EmailActivityDayData $value) => $value->toArray(), $this->daily);
        $data['days'] = $this->days;
        $data['delivered'] = $this->delivered;
        $data['emails'] = $this->emails;
        $data['failed'] = $this->failed;
        $data['recent'] = array_map(static fn (EmailMessageData $value) => $value->toArray(), $this->recent);
        $data['refused'] = $this->refused;
        $data['retrying'] = $this->retrying;

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
