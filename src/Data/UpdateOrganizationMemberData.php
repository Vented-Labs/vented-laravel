<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\OrganizationRole;
use Vented\OptionalValue;

final readonly class UpdateOrganizationMemberData
{
    /**
     * @param  list<string>|OptionalValue  $project_ids
     */
    public function __construct(
        public bool|OptionalValue $all_projects = OptionalValue::Missing,
        public array|OptionalValue $project_ids = OptionalValue::Missing,
        public OrganizationRole|OptionalValue $role = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            all_projects: array_key_exists('all_projects', $data) ? (bool) $data['all_projects'] : OptionalValue::Missing,
            project_ids: array_key_exists('project_ids', $data) ? array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['project_ids'])) : OptionalValue::Missing,
            role: array_key_exists('role', $data) ? OrganizationRole::from((string) $data['role']) : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->all_projects !== OptionalValue::Missing) {
            $data['all_projects'] = $this->all_projects;
        }
        if ($this->project_ids !== OptionalValue::Missing) {
            $data['project_ids'] = $this->project_ids;
        }
        if ($this->role !== OptionalValue::Missing) {
            $data['role'] = $this->role->value;
        }

        return $data;
    }

    /**
     * @return list<mixed>
     */
    private static function listValue(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \InvalidArgumentException('Expected an array value.');
        }

        return array_values($value);
    }
}
