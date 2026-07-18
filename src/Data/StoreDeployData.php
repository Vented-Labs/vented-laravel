<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StoreDeployData
{
    public function __construct(
        public string $app_id,
        public ?string $commit_sha,
        public ?string $message,
        public ?string $ref,
        public ?string $trigger_id,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            app_id: (string) $data['app_id'],
            commit_sha: $data['commit_sha'] === null ? null : (string) $data['commit_sha'],
            message: $data['message'] === null ? null : (string) $data['message'],
            ref: $data['ref'] === null ? null : (string) $data['ref'],
            trigger_id: $data['trigger_id'] === null ? null : (string) $data['trigger_id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['app_id'] = $this->app_id;
        $data['commit_sha'] = $this->commit_sha === null ? null : $this->commit_sha;
        $data['message'] = $this->message === null ? null : $this->message;
        $data['ref'] = $this->ref === null ? null : $this->ref;
        $data['trigger_id'] = $this->trigger_id === null ? null : $this->trigger_id;

        return $data;
    }
}
