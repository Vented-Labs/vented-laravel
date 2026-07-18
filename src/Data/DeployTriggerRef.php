<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\DeployTriggerType;

final readonly class DeployTriggerRef
{
    public function __construct(
        public string $id,
        public string $name,
        public DeployTriggerType $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) $data['id'],
            name: (string) $data['name'],
            type: DeployTriggerType::from((string) $data['type']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['type'] = $this->type->value;

        return $data;
    }
}
