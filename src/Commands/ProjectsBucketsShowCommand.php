<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBucketsShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:buckets:show {project : project path parameter} {environment : environment path parameter} {bucket : bucket path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show an object storage bucket';

    protected function operationId(): string
    {
        return 'projects.buckets.show';
    }
}
