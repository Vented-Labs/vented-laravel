<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class EmailActivityDayData
{
    public function __construct(
        public string $date,
        public int $emails,
        public int $problems,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            date: (string) $data['date'],
            emails: (int) $data['emails'],
            problems: (int) $data['problems'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['date'] = $this->date;
        $data['emails'] = $this->emails;
        $data['problems'] = $this->problems;

        return $data;
    }
}
