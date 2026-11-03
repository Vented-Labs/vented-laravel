<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppLogLineData
{
    public function __construct(
        public string $container_role,
        public string $id,
        public ?string $intent_id,
        public string $line,
        public string $occurred_at,
        public string $stream,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            container_role: (string) $data['container_role'],
            id: (string) $data['id'],
            intent_id: $data['intent_id'] === null ? null : (string) $data['intent_id'],
            line: (string) $data['line'],
            occurred_at: (string) $data['occurred_at'],
            stream: (string) $data['stream'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['container_role'] = $this->container_role;
        $data['id'] = $this->id;
        $data['intent_id'] = $this->intent_id === null ? null : $this->intent_id;
        $data['line'] = $this->line;
        $data['occurred_at'] = $this->occurred_at;
        $data['stream'] = $this->stream;

        return $data;
    }
}
