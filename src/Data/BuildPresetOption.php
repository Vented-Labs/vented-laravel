<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\BuildPreset;
use Vented\Enums\DeployType;

final readonly class BuildPresetOption
{
    public function __construct(
        public ?string $build_command,
        public DeployType $deploy_type,
        public ?string $health_check_path,
        public string $icon,
        public ?string $install_command,
        public string $label,
        public ?string $post_release_command,
        public ?string $release_command,
        public BuildPreset $value,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            build_command: $data['build_command'] === null ? null : (string) $data['build_command'],
            deploy_type: DeployType::from((string) $data['deploy_type']),
            health_check_path: $data['health_check_path'] === null ? null : (string) $data['health_check_path'],
            icon: (string) $data['icon'],
            install_command: $data['install_command'] === null ? null : (string) $data['install_command'],
            label: (string) $data['label'],
            post_release_command: $data['post_release_command'] === null ? null : (string) $data['post_release_command'],
            release_command: $data['release_command'] === null ? null : (string) $data['release_command'],
            value: BuildPreset::from((string) $data['value']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['build_command'] = $this->build_command === null ? null : $this->build_command;
        $data['deploy_type'] = $this->deploy_type->value;
        $data['health_check_path'] = $this->health_check_path === null ? null : $this->health_check_path;
        $data['icon'] = $this->icon;
        $data['install_command'] = $this->install_command === null ? null : $this->install_command;
        $data['label'] = $this->label;
        $data['post_release_command'] = $this->post_release_command === null ? null : $this->post_release_command;
        $data['release_command'] = $this->release_command === null ? null : $this->release_command;
        $data['value'] = $this->value->value;

        return $data;
    }
}
