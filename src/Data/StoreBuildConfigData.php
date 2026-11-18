<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\DeployType;

final readonly class StoreBuildConfigData
{
    public function __construct(
        public string $branch,
        public ?string $build_command,
        public int $builds_to_keep,
        public bool $deploy_on_push,
        public ?string $deploy_path,
        public DeployType $deploy_type,
        public ?string $health_check_path,
        public ?string $install_command,
        public ?string $integration_id,
        public string $name,
        public ?string $post_release_command,
        public ?string $release_command,
        public string $repository,
        public ?string $root_directory,
        public string $storage_id,
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
            deploy_on_push: (bool) $data['deploy_on_push'],
            deploy_path: $data['deploy_path'] === null ? null : (string) $data['deploy_path'],
            deploy_type: DeployType::from((string) $data['deploy_type']),
            health_check_path: $data['health_check_path'] === null ? null : (string) $data['health_check_path'],
            install_command: $data['install_command'] === null ? null : (string) $data['install_command'],
            integration_id: $data['integration_id'] === null ? null : (string) $data['integration_id'],
            name: (string) $data['name'],
            post_release_command: $data['post_release_command'] === null ? null : (string) $data['post_release_command'],
            release_command: $data['release_command'] === null ? null : (string) $data['release_command'],
            repository: (string) $data['repository'],
            root_directory: $data['root_directory'] === null ? null : (string) $data['root_directory'],
            storage_id: (string) $data['storage_id'],
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
        $data['deploy_on_push'] = $this->deploy_on_push;
        $data['deploy_path'] = $this->deploy_path === null ? null : $this->deploy_path;
        $data['deploy_type'] = $this->deploy_type->value;
        $data['health_check_path'] = $this->health_check_path === null ? null : $this->health_check_path;
        $data['install_command'] = $this->install_command === null ? null : $this->install_command;
        $data['integration_id'] = $this->integration_id === null ? null : $this->integration_id;
        $data['name'] = $this->name;
        $data['post_release_command'] = $this->post_release_command === null ? null : $this->post_release_command;
        $data['release_command'] = $this->release_command === null ? null : $this->release_command;
        $data['repository'] = $this->repository;
        $data['root_directory'] = $this->root_directory === null ? null : $this->root_directory;
        $data['storage_id'] = $this->storage_id;

        return $data;
    }
}
