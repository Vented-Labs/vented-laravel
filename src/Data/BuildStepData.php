<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\BuildStep;
use Vented\Enums\BuildStepState;
use Vented\Enums\StatusTone;

final readonly class BuildStepData
{
    public function __construct(
        public string $label,
        public BuildStepState $state,
        public BuildStep $step,
        public StatusTone $tone,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            label: (string) $data['label'],
            state: BuildStepState::from((string) $data['state']),
            step: BuildStep::from((string) $data['step']),
            tone: StatusTone::from((string) $data['tone']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['label'] = $this->label;
        $data['state'] = $this->state->value;
        $data['step'] = $this->step->value;
        $data['tone'] = $this->tone->value;

        return $data;
    }
}
