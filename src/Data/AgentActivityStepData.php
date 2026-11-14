<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AgentActivityStepData
{
    public function __construct(
        public string $at,
        public string $line,
        public string $status,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            at: (string) $data['at'],
            line: (string) $data['line'],
            status: (string) $data['status'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['at'] = $this->at;
        $data['line'] = $this->line;
        $data['status'] = $this->status;

        return $data;
    }
}
