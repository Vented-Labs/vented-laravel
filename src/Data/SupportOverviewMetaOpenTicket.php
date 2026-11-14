<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SupportOverviewMetaOpenTicket
{
    public function __construct(
        public string $id,
        public ?SupportOverviewMetaProject $project,
        public StatusData $status,
        public string $subject,
        public string $updated_at,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) $data['id'],
            project: $data['project'] === null ? null : SupportOverviewMetaProject::fromArray(self::objectValue($data['project'])),
            status: StatusData::fromArray(self::objectValue($data['status'])),
            subject: (string) $data['subject'],
            updated_at: (string) $data['updated_at'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = $this->id;
        $data['project'] = $this->project === null ? null : $this->project->toArray();
        $data['status'] = $this->status->toArray();
        $data['subject'] = $this->subject;
        $data['updated_at'] = $this->updated_at;

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
