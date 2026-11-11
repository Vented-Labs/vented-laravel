<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ProjectPinData
{
    public function __construct(
        public string $id,
        public int $position,
        public string $project_id,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) $data['id'],
            position: (int) $data['position'],
            project_id: (string) $data['project_id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = $this->id;
        $data['position'] = $this->position;
        $data['project_id'] = $this->project_id;

        return $data;
    }
}
