<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class UpdateOnboardingData
{
    public function __construct(
        public string $experience,
        public string $goal,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            experience: (string) $data['experience'],
            goal: (string) $data['goal'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['experience'] = $this->experience;
        $data['goal'] = $this->goal;

        return $data;
    }
}
