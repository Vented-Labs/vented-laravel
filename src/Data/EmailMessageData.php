<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class EmailMessageData
{
    /**
     * @param  list<string>  $recipients
     */
    public function __construct(
        public ?EmailMessageAppData $app,
        public ?string $app_id,
        public int $attempts,
        public ?string $detail,
        public string $id,
        public int $recipient_count,
        public array $recipients,
        public string $sent_at,
        public StatusData $status,
        public string $subject,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            app: $data['app'] === null ? null : EmailMessageAppData::fromArray(self::objectValue($data['app'])),
            app_id: $data['app_id'] === null ? null : (string) $data['app_id'],
            attempts: (int) $data['attempts'],
            detail: $data['detail'] === null ? null : (string) $data['detail'],
            id: (string) $data['id'],
            recipient_count: (int) $data['recipient_count'],
            recipients: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['recipients'])),
            sent_at: (string) $data['sent_at'],
            status: StatusData::fromArray(self::objectValue($data['status'])),
            subject: (string) $data['subject'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['app'] = $this->app === null ? null : $this->app->toArray();
        $data['app_id'] = $this->app_id === null ? null : $this->app_id;
        $data['attempts'] = $this->attempts;
        $data['detail'] = $this->detail === null ? null : $this->detail;
        $data['id'] = $this->id;
        $data['recipient_count'] = $this->recipient_count;
        $data['recipients'] = $this->recipients;
        $data['sent_at'] = $this->sent_at;
        $data['status'] = $this->status->toArray();
        $data['subject'] = $this->subject;

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
