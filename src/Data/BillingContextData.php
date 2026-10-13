<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BillingContextData
{
    public function __construct(
        public ?string $billing_url,
        public string $body,
        public string $project_id,
        public string $project_name,
        public string $stage,
        public string $title,
        public string $tone,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            billing_url: $data['billing_url'] === null ? null : (string) $data['billing_url'],
            body: (string) $data['body'],
            project_id: (string) $data['project_id'],
            project_name: (string) $data['project_name'],
            stage: (string) $data['stage'],
            title: (string) $data['title'],
            tone: (string) $data['tone'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['billing_url'] = $this->billing_url === null ? null : $this->billing_url;
        $data['body'] = $this->body;
        $data['project_id'] = $this->project_id;
        $data['project_name'] = $this->project_name;
        $data['stage'] = $this->stage;
        $data['title'] = $this->title;
        $data['tone'] = $this->tone;

        return $data;
    }
}
