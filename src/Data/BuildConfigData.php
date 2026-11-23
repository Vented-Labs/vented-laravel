<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\DeployTriggerType;
use Vented\Enums\DeployType;

final readonly class BuildConfigData
{
    /**
     * @param  list<DeployTriggerType>  $trigger_types
     */
    public function __construct(
        public string $branch,
        public ?string $build_command,
        public int $builds_to_keep,
        public string $created_at,
        public ?string $deploy_path,
        public DeployType $deploy_type,
        public ?GitRepositoryRef $git_repository,
        public ?NamedOption $group,
        public ?string $health_check_path,
        public string $id,
        public ?string $install_command,
        public ?IntegrationRef $integration,
        public ?DeployBuildRef $latest_build,
        public string $name,
        public ?string $post_release_command,
        public ?string $release_command,
        public string $repository,
        public string $root_directory,
        public ?BuildConfigStorage $storage,
        public array $trigger_types,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            branch: (string) $data['branch'],
            build_command: $data['build_command'] === null ? null : (string) $data['build_command'],
            builds_to_keep: (int) $data['builds_to_keep'],
            created_at: (string) $data['created_at'],
            deploy_path: $data['deploy_path'] === null ? null : (string) $data['deploy_path'],
            deploy_type: DeployType::from((string) $data['deploy_type']),
            git_repository: $data['git_repository'] === null ? null : GitRepositoryRef::fromArray(self::objectValue($data['git_repository'])),
            group: $data['group'] === null ? null : NamedOption::fromArray(self::objectValue($data['group'])),
            health_check_path: $data['health_check_path'] === null ? null : (string) $data['health_check_path'],
            id: (string) $data['id'],
            install_command: $data['install_command'] === null ? null : (string) $data['install_command'],
            integration: $data['integration'] === null ? null : IntegrationRef::fromArray(self::objectValue($data['integration'])),
            latest_build: $data['latest_build'] === null ? null : DeployBuildRef::fromArray(self::objectValue($data['latest_build'])),
            name: (string) $data['name'],
            post_release_command: $data['post_release_command'] === null ? null : (string) $data['post_release_command'],
            release_command: $data['release_command'] === null ? null : (string) $data['release_command'],
            repository: (string) $data['repository'],
            root_directory: (string) $data['root_directory'],
            storage: $data['storage'] === null ? null : BuildConfigStorage::fromArray(self::objectValue($data['storage'])),
            trigger_types: array_map(static fn (mixed $value): DeployTriggerType => DeployTriggerType::from((string) $value), self::listValue($data['trigger_types'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['branch'] = $this->branch;
        $data['build_command'] = $this->build_command === null ? null : $this->build_command;
        $data['builds_to_keep'] = $this->builds_to_keep;
        $data['created_at'] = $this->created_at;
        $data['deploy_path'] = $this->deploy_path === null ? null : $this->deploy_path;
        $data['deploy_type'] = $this->deploy_type->value;
        $data['git_repository'] = $this->git_repository === null ? null : $this->git_repository->toArray();
        $data['group'] = $this->group === null ? null : $this->group->toArray();
        $data['health_check_path'] = $this->health_check_path === null ? null : $this->health_check_path;
        $data['id'] = $this->id;
        $data['install_command'] = $this->install_command === null ? null : $this->install_command;
        $data['integration'] = $this->integration === null ? null : $this->integration->toArray();
        $data['latest_build'] = $this->latest_build === null ? null : $this->latest_build->toArray();
        $data['name'] = $this->name;
        $data['post_release_command'] = $this->post_release_command === null ? null : $this->post_release_command;
        $data['release_command'] = $this->release_command === null ? null : $this->release_command;
        $data['repository'] = $this->repository;
        $data['root_directory'] = $this->root_directory;
        $data['storage'] = $this->storage === null ? null : $this->storage->toArray();
        $data['trigger_types'] = array_map(static fn (DeployTriggerType $value) => $value->value, $this->trigger_types);

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
