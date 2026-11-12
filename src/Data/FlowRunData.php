<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class FlowRunData
{
    /**
     * @param  array<string, mixed>  $created
     */
    public function __construct(
        public array $created,
        public string $flow,
        public string $id,
        public ?string $next_url,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            created: self::objectValue($data['created']),
            flow: (string) $data['flow'],
            id: (string) $data['id'],
            next_url: $data['next_url'] === null ? null : (string) $data['next_url'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['created'] = $this->created;
        $data['flow'] = $this->flow;
        $data['id'] = $this->id;
        $data['next_url'] = $this->next_url === null ? null : $this->next_url;

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
