<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppActions
{
    public function __construct(
        public bool $delete,
        public bool $restart,
        public bool $start,
        public bool $stop,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            delete: (bool) $data['delete'],
            restart: (bool) $data['restart'],
            start: (bool) $data['start'],
            stop: (bool) $data['stop'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['delete'] = $this->delete;
        $data['restart'] = $this->restart;
        $data['start'] = $this->start;
        $data['stop'] = $this->stop;

        return $data;
    }
}
