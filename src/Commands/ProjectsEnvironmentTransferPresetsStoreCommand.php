<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsEnvironmentTransferPresetsStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:environment-transfer-presets:create {project : project path parameter} {environment : environment path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Create an environment transfer preset';

    protected function operationId(): string
    {
        return 'projects.environment-transfer-presets.store';
    }
}
