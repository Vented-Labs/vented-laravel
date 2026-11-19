<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class EmailActivityAppData
{
    public function __construct(
        public ?EmailMessageAppData $app,
        public ?string $app_id,
        public int $emails,
        public string $last_sent_at,
        public int $messages,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            app: $data['app'] === null ? null : EmailMessageAppData::fromArray(self::objectValue($data['app'])),
            app_id: $data['app_id'] === null ? null : (string) $data['app_id'],
            emails: (int) $data['emails'],
            last_sent_at: (string) $data['last_sent_at'],
            messages: (int) $data['messages'],
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
        $data['emails'] = $this->emails;
        $data['last_sent_at'] = $this->last_sent_at;
        $data['messages'] = $this->messages;

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
