<?php

declare(strict_types=1);

namespace Vented\Enums;

enum EnvironmentTransferResourceType: string
{
    case App = 'app';
    case Service = 'service';
    case BlockStorage = 'block_storage';
    case ObjectStorage = 'object_storage';
    case AppBlockStorageAttachment = 'app_block_storage_attachment';
    case InternalBinding = 'internal_binding';
    case CronJob = 'cron_job';
    case DeployTrigger = 'deploy_trigger';
    case BackupSettings = 'backup_settings';
    case SshGrant = 'ssh_grant';
    case DnsBinding = 'dns_binding';
}
