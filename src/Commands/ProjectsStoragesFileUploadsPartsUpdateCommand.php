<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsStoragesFileUploadsPartsUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:storage-file-upload-parts:update {project : project path parameter} {environment : environment path parameter} {storage : storage path parameter} {upload : upload path parameter} {part : part path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Send one part of an upload';

    protected function operationId(): string
    {
        return 'projects.storages.file-uploads.parts.update';
    }
}
