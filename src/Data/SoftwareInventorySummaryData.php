<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SoftwareInventorySummaryData
{
    public function __construct(
        public int $affected_stacks,
        public int $apps,
        public int $checking_stacks,
        public int $independent_resources,
        public int $linked_resources,
        public int $provisioning_stacks,
        public int $ready_stacks,
        public int $resources,
        public int $resources_needing_attention,
        public int $services,
        public int $stack_requirement_issues,
        public int $stacks,
        public int $storage,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            affected_stacks: (int) $data['affected_stacks'],
            apps: (int) $data['apps'],
            checking_stacks: (int) $data['checking_stacks'],
            independent_resources: (int) $data['independent_resources'],
            linked_resources: (int) $data['linked_resources'],
            provisioning_stacks: (int) $data['provisioning_stacks'],
            ready_stacks: (int) $data['ready_stacks'],
            resources: (int) $data['resources'],
            resources_needing_attention: (int) $data['resources_needing_attention'],
            services: (int) $data['services'],
            stack_requirement_issues: (int) $data['stack_requirement_issues'],
            stacks: (int) $data['stacks'],
            storage: (int) $data['storage'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['affected_stacks'] = $this->affected_stacks;
        $data['apps'] = $this->apps;
        $data['checking_stacks'] = $this->checking_stacks;
        $data['independent_resources'] = $this->independent_resources;
        $data['linked_resources'] = $this->linked_resources;
        $data['provisioning_stacks'] = $this->provisioning_stacks;
        $data['ready_stacks'] = $this->ready_stacks;
        $data['resources'] = $this->resources;
        $data['resources_needing_attention'] = $this->resources_needing_attention;
        $data['services'] = $this->services;
        $data['stack_requirement_issues'] = $this->stack_requirement_issues;
        $data['stacks'] = $this->stacks;
        $data['storage'] = $this->storage;

        return $data;
    }
}
