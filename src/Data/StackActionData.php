<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StackActionData
{
    public function __construct(
        public bool $destructive,
        public string $id,
        public bool $implemented,
        public string $label,
        public ?string $reason,
        public string $target_role,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            destructive: (bool) $data['destructive'],
            id: (string) $data['id'],
            implemented: (bool) $data['implemented'],
            label: (string) $data['label'],
            reason: $data['reason'] === null ? null : (string) $data['reason'],
            target_role: (string) $data['target_role'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['destructive'] = $this->destructive;
        $data['id'] = $this->id;
        $data['implemented'] = $this->implemented;
        $data['label'] = $this->label;
        $data['reason'] = $this->reason === null ? null : $this->reason;
        $data['target_role'] = $this->target_role;

        return $data;
    }
}
