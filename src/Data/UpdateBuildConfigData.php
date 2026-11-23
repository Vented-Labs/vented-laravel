<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\DeployType;
use Vented\OptionalValue;

final readonly class UpdateBuildConfigData
{
    public function __construct(
        public string|OptionalValue $branch = OptionalValue::Missing,
        public string|null|OptionalValue $build_command = OptionalValue::Missing,
        public string|null|OptionalValue $build_group_id = OptionalValue::Missing,
        public int|OptionalValue $builds_to_keep = OptionalValue::Missing,
        public string|null|OptionalValue $deploy_path = OptionalValue::Missing,
        public DeployType|OptionalValue $deploy_type = OptionalValue::Missing,
        public string|null|OptionalValue $git_connection_id = OptionalValue::Missing,
        public string|null|OptionalValue $health_check_path = OptionalValue::Missing,
        public string|null|OptionalValue $install_command = OptionalValue::Missing,
        public string|OptionalValue $name = OptionalValue::Missing,
        public string|null|OptionalValue $post_release_command = OptionalValue::Missing,
        public string|null|OptionalValue $release_command = OptionalValue::Missing,
        public string|null|OptionalValue $repository = OptionalValue::Missing,
        public string|null|OptionalValue $repository_id = OptionalValue::Missing,
        public string|null|OptionalValue $root_directory = OptionalValue::Missing,
        public string|OptionalValue $storage_id = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            branch: array_key_exists('branch', $data) ? (string) $data['branch'] : OptionalValue::Missing,
            build_command: array_key_exists('build_command', $data) ? $data['build_command'] === null ? null : (string) $data['build_command'] : OptionalValue::Missing,
            build_group_id: array_key_exists('build_group_id', $data) ? $data['build_group_id'] === null ? null : (string) $data['build_group_id'] : OptionalValue::Missing,
            builds_to_keep: array_key_exists('builds_to_keep', $data) ? (int) $data['builds_to_keep'] : OptionalValue::Missing,
            deploy_path: array_key_exists('deploy_path', $data) ? $data['deploy_path'] === null ? null : (string) $data['deploy_path'] : OptionalValue::Missing,
            deploy_type: array_key_exists('deploy_type', $data) ? DeployType::from((string) $data['deploy_type']) : OptionalValue::Missing,
            git_connection_id: array_key_exists('git_connection_id', $data) ? $data['git_connection_id'] === null ? null : (string) $data['git_connection_id'] : OptionalValue::Missing,
            health_check_path: array_key_exists('health_check_path', $data) ? $data['health_check_path'] === null ? null : (string) $data['health_check_path'] : OptionalValue::Missing,
            install_command: array_key_exists('install_command', $data) ? $data['install_command'] === null ? null : (string) $data['install_command'] : OptionalValue::Missing,
            name: array_key_exists('name', $data) ? (string) $data['name'] : OptionalValue::Missing,
            post_release_command: array_key_exists('post_release_command', $data) ? $data['post_release_command'] === null ? null : (string) $data['post_release_command'] : OptionalValue::Missing,
            release_command: array_key_exists('release_command', $data) ? $data['release_command'] === null ? null : (string) $data['release_command'] : OptionalValue::Missing,
            repository: array_key_exists('repository', $data) ? $data['repository'] === null ? null : (string) $data['repository'] : OptionalValue::Missing,
            repository_id: array_key_exists('repository_id', $data) ? $data['repository_id'] === null ? null : (string) $data['repository_id'] : OptionalValue::Missing,
            root_directory: array_key_exists('root_directory', $data) ? $data['root_directory'] === null ? null : (string) $data['root_directory'] : OptionalValue::Missing,
            storage_id: array_key_exists('storage_id', $data) ? (string) $data['storage_id'] : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->branch !== OptionalValue::Missing) {
            $data['branch'] = $this->branch;
        }
        if ($this->build_command !== OptionalValue::Missing) {
            $data['build_command'] = $this->build_command === null ? null : $this->build_command;
        }
        if ($this->build_group_id !== OptionalValue::Missing) {
            $data['build_group_id'] = $this->build_group_id === null ? null : $this->build_group_id;
        }
        if ($this->builds_to_keep !== OptionalValue::Missing) {
            $data['builds_to_keep'] = $this->builds_to_keep;
        }
        if ($this->deploy_path !== OptionalValue::Missing) {
            $data['deploy_path'] = $this->deploy_path === null ? null : $this->deploy_path;
        }
        if ($this->deploy_type !== OptionalValue::Missing) {
            $data['deploy_type'] = $this->deploy_type->value;
        }
        if ($this->git_connection_id !== OptionalValue::Missing) {
            $data['git_connection_id'] = $this->git_connection_id === null ? null : $this->git_connection_id;
        }
        if ($this->health_check_path !== OptionalValue::Missing) {
            $data['health_check_path'] = $this->health_check_path === null ? null : $this->health_check_path;
        }
        if ($this->install_command !== OptionalValue::Missing) {
            $data['install_command'] = $this->install_command === null ? null : $this->install_command;
        }
        if ($this->name !== OptionalValue::Missing) {
            $data['name'] = $this->name;
        }
        if ($this->post_release_command !== OptionalValue::Missing) {
            $data['post_release_command'] = $this->post_release_command === null ? null : $this->post_release_command;
        }
        if ($this->release_command !== OptionalValue::Missing) {
            $data['release_command'] = $this->release_command === null ? null : $this->release_command;
        }
        if ($this->repository !== OptionalValue::Missing) {
            $data['repository'] = $this->repository === null ? null : $this->repository;
        }
        if ($this->repository_id !== OptionalValue::Missing) {
            $data['repository_id'] = $this->repository_id === null ? null : $this->repository_id;
        }
        if ($this->root_directory !== OptionalValue::Missing) {
            $data['root_directory'] = $this->root_directory === null ? null : $this->root_directory;
        }
        if ($this->storage_id !== OptionalValue::Missing) {
            $data['storage_id'] = $this->storage_id;
        }

        return $data;
    }
}
