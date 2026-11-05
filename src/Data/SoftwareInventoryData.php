<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SoftwareInventoryData
{
    /**
     * @param  list<SoftwareInventoryIssueData>  $issues
     * @param  list<SoftwareResourceContextData>  $resources
     * @param  list<SoftwareStackSummaryData>  $stacks
     */
    public function __construct(
        public array $issues,
        public array $resources,
        public string $revision,
        public array $stacks,
        public SoftwareInventorySummaryData $summary,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            issues: array_map(static fn (mixed $value): SoftwareInventoryIssueData => SoftwareInventoryIssueData::fromArray(self::objectValue($value)), self::listValue($data['issues'])),
            resources: array_map(static fn (mixed $value): SoftwareResourceContextData => SoftwareResourceContextData::fromArray(self::objectValue($value)), self::listValue($data['resources'])),
            revision: (string) $data['revision'],
            stacks: array_map(static fn (mixed $value): SoftwareStackSummaryData => SoftwareStackSummaryData::fromArray(self::objectValue($value)), self::listValue($data['stacks'])),
            summary: SoftwareInventorySummaryData::fromArray(self::objectValue($data['summary'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['issues'] = array_map(static fn (SoftwareInventoryIssueData $value) => $value->toArray(), $this->issues);
        $data['resources'] = array_map(static fn (SoftwareResourceContextData $value) => $value->toArray(), $this->resources);
        $data['revision'] = $this->revision;
        $data['stacks'] = array_map(static fn (SoftwareStackSummaryData $value) => $value->toArray(), $this->stacks);
        $data['summary'] = $this->summary->toArray();

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
