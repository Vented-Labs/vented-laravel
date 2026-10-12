<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class GettingStartedData
{
    /**
     * @param  list<GettingStartedStepData>  $steps
     */
    public function __construct(
        public ?string $experience,
        public ?string $goal,
        public ?string $project_name,
        public array $steps,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            experience: $data['experience'] === null ? null : (string) $data['experience'],
            goal: $data['goal'] === null ? null : (string) $data['goal'],
            project_name: $data['project_name'] === null ? null : (string) $data['project_name'],
            steps: array_map(static fn (mixed $value): GettingStartedStepData => GettingStartedStepData::fromArray(self::objectValue($value)), self::listValue($data['steps'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['experience'] = $this->experience === null ? null : $this->experience;
        $data['goal'] = $this->goal === null ? null : $this->goal;
        $data['project_name'] = $this->project_name === null ? null : $this->project_name;
        $data['steps'] = array_map(static fn (GettingStartedStepData $value) => $value->toArray(), $this->steps);

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
