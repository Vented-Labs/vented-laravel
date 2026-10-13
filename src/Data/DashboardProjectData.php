<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class DashboardProjectData
{
    public function __construct(
        public ?int $apps,
        public ?BillingContextData $billing_context,
        public ?int $domains,
        public ?int $environments,
        public string $id,
        public bool $is_owner,
        public bool $locked,
        public ?string $members_url,
        public string $name,
        public bool $needs_attention,
        public bool $needs_setup,
        public ?string $plan_url,
        public string $role,
        public ?int $services,
        public ?string $setup_url,
        public ?StatusData $status,
        public string $url,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            apps: $data['apps'] === null ? null : (int) $data['apps'],
            billing_context: $data['billing_context'] === null ? null : BillingContextData::fromArray(self::objectValue($data['billing_context'])),
            domains: $data['domains'] === null ? null : (int) $data['domains'],
            environments: $data['environments'] === null ? null : (int) $data['environments'],
            id: (string) $data['id'],
            is_owner: (bool) $data['is_owner'],
            locked: (bool) $data['locked'],
            members_url: $data['members_url'] === null ? null : (string) $data['members_url'],
            name: (string) $data['name'],
            needs_attention: (bool) $data['needs_attention'],
            needs_setup: (bool) $data['needs_setup'],
            plan_url: $data['plan_url'] === null ? null : (string) $data['plan_url'],
            role: (string) $data['role'],
            services: $data['services'] === null ? null : (int) $data['services'],
            setup_url: $data['setup_url'] === null ? null : (string) $data['setup_url'],
            status: $data['status'] === null ? null : StatusData::fromArray(self::objectValue($data['status'])),
            url: (string) $data['url'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['apps'] = $this->apps === null ? null : $this->apps;
        $data['billing_context'] = $this->billing_context === null ? null : $this->billing_context->toArray();
        $data['domains'] = $this->domains === null ? null : $this->domains;
        $data['environments'] = $this->environments === null ? null : $this->environments;
        $data['id'] = $this->id;
        $data['is_owner'] = $this->is_owner;
        $data['locked'] = $this->locked;
        $data['members_url'] = $this->members_url === null ? null : $this->members_url;
        $data['name'] = $this->name;
        $data['needs_attention'] = $this->needs_attention;
        $data['needs_setup'] = $this->needs_setup;
        $data['plan_url'] = $this->plan_url === null ? null : $this->plan_url;
        $data['role'] = $this->role;
        $data['services'] = $this->services === null ? null : $this->services;
        $data['setup_url'] = $this->setup_url === null ? null : $this->setup_url;
        $data['status'] = $this->status === null ? null : $this->status->toArray();
        $data['url'] = $this->url;

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
