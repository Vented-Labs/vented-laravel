<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AgentActivityData
{
    /**
     * @param  list<AgentActivityStepData>  $steps
     */
    public function __construct(
        public string $agent,
        public bool $sample,
        public StatusData $status,
        public array $steps,
        public ?string $url,
        public string $working_on,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            agent: (string) $data['agent'],
            sample: (bool) $data['sample'],
            status: StatusData::fromArray(self::objectValue($data['status'])),
            steps: array_map(static fn (mixed $value): AgentActivityStepData => AgentActivityStepData::fromArray(self::objectValue($value)), self::listValue($data['steps'])),
            url: $data['url'] === null ? null : (string) $data['url'],
            working_on: (string) $data['working_on'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['agent'] = $this->agent;
        $data['sample'] = $this->sample;
        $data['status'] = $this->status->toArray();
        $data['steps'] = array_map(static fn (AgentActivityStepData $value) => $value->toArray(), $this->steps);
        $data['url'] = $this->url === null ? null : $this->url;
        $data['working_on'] = $this->working_on;

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
