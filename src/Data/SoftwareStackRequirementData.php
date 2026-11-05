<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SoftwareStackRequirementData
{
    public function __construct(
        public string $label,
        public ?string $message,
        public bool $required,
        public string $role,
        public bool $satisfied,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            label: (string) $data['label'],
            message: $data['message'] === null ? null : (string) $data['message'],
            required: (bool) $data['required'],
            role: (string) $data['role'],
            satisfied: (bool) $data['satisfied'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['label'] = $this->label;
        $data['message'] = $this->message === null ? null : $this->message;
        $data['required'] = $this->required;
        $data['role'] = $this->role;
        $data['satisfied'] = $this->satisfied;

        return $data;
    }
}
