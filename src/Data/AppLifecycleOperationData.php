<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppLifecycleOperationData
{
    public function __construct(
        public string $action,
        public string $app_id,
        public string $decision,
        public int $generation,
        public string $id,
        public string $idempotency_key,
        public ?string $rejected_reason,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            action: (string) $data['action'],
            app_id: (string) $data['app_id'],
            decision: (string) $data['decision'],
            generation: (int) $data['generation'],
            id: (string) $data['id'],
            idempotency_key: (string) $data['idempotency_key'],
            rejected_reason: $data['rejected_reason'] === null ? null : (string) $data['rejected_reason'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['action'] = $this->action;
        $data['app_id'] = $this->app_id;
        $data['decision'] = $this->decision;
        $data['generation'] = $this->generation;
        $data['id'] = $this->id;
        $data['idempotency_key'] = $this->idempotency_key;
        $data['rejected_reason'] = $this->rejected_reason === null ? null : $this->rejected_reason;

        return $data;
    }
}
