<?php

declare(strict_types=1);

namespace Vented\Generated;

use Illuminate\Console\Command;
use Vented\Commands\AccountApiTokensDestroyCommand;
use Vented\Commands\AccountApiTokensIndexCommand;
use Vented\Commands\AccountApiTokensStoreCommand;
use Vented\Commands\PlatformLocationsIndexCommand;
use Vented\Commands\ProjectsAppsBindingsCommand;
use Vented\Commands\ProjectsAppsBindingsDestroyCommand;
use Vented\Commands\ProjectsAppsBindingsStoreCommand;
use Vented\Commands\ProjectsAppsConfigurationCommand;
use Vented\Commands\ProjectsAppsDeployCommand;
use Vented\Commands\ProjectsAppsDestroyCommand;
use Vented\Commands\ProjectsAppsDomainsCommand;
use Vented\Commands\ProjectsAppsIndexCommand;
use Vented\Commands\ProjectsAppsRestartCommand;
use Vented\Commands\ProjectsAppsShowCommand;
use Vented\Commands\ProjectsAppsStartCommand;
use Vented\Commands\ProjectsAppsStopCommand;
use Vented\Commands\ProjectsAppsStorageCommand;
use Vented\Commands\ProjectsAppsStoreCommand;
use Vented\Commands\ProjectsAppsUpdateCommand;
use Vented\Commands\ProjectsBackupsDestroyCommand;
use Vented\Commands\ProjectsBackupSettingsShowCommand;
use Vented\Commands\ProjectsBackupSettingsUpdateCommand;
use Vented\Commands\ProjectsBackupsIndexCommand;
use Vented\Commands\ProjectsBackupsStoreCommand;
use Vented\Commands\ProjectsBlockStoragesBackupsCommand;
use Vented\Commands\ProjectsBlockStoragesDestroyCommand;
use Vented\Commands\ProjectsBlockStoragesIndexCommand;
use Vented\Commands\ProjectsBlockStoragesShowCommand;
use Vented\Commands\ProjectsBlockStoragesStoreCommand;
use Vented\Commands\ProjectsDeploysIndexCommand;
use Vented\Commands\ProjectsDeploysStoreCommand;
use Vented\Commands\ProjectsDeploysTemplatesIndexCommand;
use Vented\Commands\ProjectsDeployTriggersDestroyCommand;
use Vented\Commands\ProjectsDeployTriggersIndexCommand;
use Vented\Commands\ProjectsDeployTriggersStoreCommand;
use Vented\Commands\ProjectsDeployTriggersUpdateCommand;
use Vented\Commands\ProjectsDestroyCommand;
use Vented\Commands\ProjectsDevelopersIndexCommand;
use Vented\Commands\ProjectsDnsZonesBindingsDestroyCommand;
use Vented\Commands\ProjectsDnsZonesBindingsIndexCommand;
use Vented\Commands\ProjectsDnsZonesBindingsStoreCommand;
use Vented\Commands\ProjectsDnsZonesBindingsUpdateCommand;
use Vented\Commands\ProjectsDnsZonesDestroyCommand;
use Vented\Commands\ProjectsDnsZonesExportCommand;
use Vented\Commands\ProjectsDnsZonesIndexCommand;
use Vented\Commands\ProjectsDnsZonesRecordsDestroyCommand;
use Vented\Commands\ProjectsDnsZonesRecordsIndexCommand;
use Vented\Commands\ProjectsDnsZonesRecordsStoreCommand;
use Vented\Commands\ProjectsDnsZonesRecordsUpdateCommand;
use Vented\Commands\ProjectsDnsZonesShowCommand;
use Vented\Commands\ProjectsDnsZonesStatusCommand;
use Vented\Commands\ProjectsDnsZonesStoreCommand;
use Vented\Commands\ProjectsDnsZonesUpdateCommand;
use Vented\Commands\ProjectsIndexCommand;
use Vented\Commands\ProjectsIntegrationsDestroyCommand;
use Vented\Commands\ProjectsIntegrationsIndexCommand;
use Vented\Commands\ProjectsIntegrationsShowCommand;
use Vented\Commands\ProjectsIntegrationsStoreCommand;
use Vented\Commands\ProjectsIntegrationsUpdateCommand;
use Vented\Commands\ProjectsMembersDestroyCommand;
use Vented\Commands\ProjectsMembersIndexCommand;
use Vented\Commands\ProjectsMembersInvitationsDestroyCommand;
use Vented\Commands\ProjectsMembersInvitationsIndexCommand;
use Vented\Commands\ProjectsMembersInvitationsStoreCommand;
use Vented\Commands\ProjectsObjectStoragesBackupsCommand;
use Vented\Commands\ProjectsObjectStoragesDestroyCommand;
use Vented\Commands\ProjectsObjectStoragesIndexCommand;
use Vented\Commands\ProjectsObjectStoragesShowCommand;
use Vented\Commands\ProjectsObjectStoragesStoreCommand;
use Vented\Commands\ProjectsOverviewCommand;
use Vented\Commands\ProjectsPlanShowCommand;
use Vented\Commands\ProjectsPlanUpdateCommand;
use Vented\Commands\ProjectsPlanUsageCommand;
use Vented\Commands\ProjectsServicesBackupsCommand;
use Vented\Commands\ProjectsServicesBindingsCommand;
use Vented\Commands\ProjectsServicesBindingsDestroyCommand;
use Vented\Commands\ProjectsServicesBindingsStoreCommand;
use Vented\Commands\ProjectsServicesConfigurationCommand;
use Vented\Commands\ProjectsServicesDestroyCommand;
use Vented\Commands\ProjectsServicesIndexCommand;
use Vented\Commands\ProjectsServicesShowCommand;
use Vented\Commands\ProjectsServicesStoreCommand;
use Vented\Commands\ProjectsServicesUpdateCommand;
use Vented\Commands\ProjectsSettingsShowCommand;
use Vented\Commands\ProjectsSettingsUpdateCommand;
use Vented\Commands\ProjectsSshKeysDestroyCommand;
use Vented\Commands\ProjectsSshKeysIndexCommand;
use Vented\Commands\ProjectsSshKeysStoreCommand;
use Vented\Commands\ProjectsStoragesFileContentsShowCommand;
use Vented\Commands\ProjectsStoragesFileContentsUpdateCommand;
use Vented\Commands\ProjectsStoragesFilesDestroyCommand;
use Vented\Commands\ProjectsStoragesFilesDownloadCommand;
use Vented\Commands\ProjectsStoragesFilesIndexCommand;
use Vented\Commands\ProjectsStoragesFilesStoreCommand;
use Vented\Commands\ProjectsStoreCommand;
use Vented\Commands\ProjectsUpdateCommand;

final class CommandRegistry
{
    /** @var list<class-string<Command>> */
    public const COMMANDS = [
        AccountApiTokensDestroyCommand::class,
        AccountApiTokensIndexCommand::class,
        AccountApiTokensStoreCommand::class,
        PlatformLocationsIndexCommand::class,
        ProjectsAppsBindingsCommand::class,
        ProjectsAppsBindingsDestroyCommand::class,
        ProjectsAppsBindingsStoreCommand::class,
        ProjectsAppsConfigurationCommand::class,
        ProjectsAppsDeployCommand::class,
        ProjectsAppsDestroyCommand::class,
        ProjectsAppsDomainsCommand::class,
        ProjectsAppsIndexCommand::class,
        ProjectsAppsRestartCommand::class,
        ProjectsAppsShowCommand::class,
        ProjectsAppsStartCommand::class,
        ProjectsAppsStopCommand::class,
        ProjectsAppsStorageCommand::class,
        ProjectsAppsStoreCommand::class,
        ProjectsAppsUpdateCommand::class,
        ProjectsBackupSettingsShowCommand::class,
        ProjectsBackupSettingsUpdateCommand::class,
        ProjectsBackupsDestroyCommand::class,
        ProjectsBackupsIndexCommand::class,
        ProjectsBackupsStoreCommand::class,
        ProjectsBlockStoragesBackupsCommand::class,
        ProjectsBlockStoragesDestroyCommand::class,
        ProjectsBlockStoragesIndexCommand::class,
        ProjectsBlockStoragesShowCommand::class,
        ProjectsBlockStoragesStoreCommand::class,
        ProjectsDeployTriggersDestroyCommand::class,
        ProjectsDeployTriggersIndexCommand::class,
        ProjectsDeployTriggersStoreCommand::class,
        ProjectsDeployTriggersUpdateCommand::class,
        ProjectsDeploysIndexCommand::class,
        ProjectsDeploysStoreCommand::class,
        ProjectsDeploysTemplatesIndexCommand::class,
        ProjectsDestroyCommand::class,
        ProjectsDevelopersIndexCommand::class,
        ProjectsDnsZonesBindingsDestroyCommand::class,
        ProjectsDnsZonesBindingsIndexCommand::class,
        ProjectsDnsZonesBindingsStoreCommand::class,
        ProjectsDnsZonesBindingsUpdateCommand::class,
        ProjectsDnsZonesDestroyCommand::class,
        ProjectsDnsZonesExportCommand::class,
        ProjectsDnsZonesIndexCommand::class,
        ProjectsDnsZonesRecordsDestroyCommand::class,
        ProjectsDnsZonesRecordsIndexCommand::class,
        ProjectsDnsZonesRecordsStoreCommand::class,
        ProjectsDnsZonesRecordsUpdateCommand::class,
        ProjectsDnsZonesShowCommand::class,
        ProjectsDnsZonesStatusCommand::class,
        ProjectsDnsZonesStoreCommand::class,
        ProjectsDnsZonesUpdateCommand::class,
        ProjectsIndexCommand::class,
        ProjectsIntegrationsDestroyCommand::class,
        ProjectsIntegrationsIndexCommand::class,
        ProjectsIntegrationsShowCommand::class,
        ProjectsIntegrationsStoreCommand::class,
        ProjectsIntegrationsUpdateCommand::class,
        ProjectsMembersDestroyCommand::class,
        ProjectsMembersIndexCommand::class,
        ProjectsMembersInvitationsDestroyCommand::class,
        ProjectsMembersInvitationsIndexCommand::class,
        ProjectsMembersInvitationsStoreCommand::class,
        ProjectsObjectStoragesBackupsCommand::class,
        ProjectsObjectStoragesDestroyCommand::class,
        ProjectsObjectStoragesIndexCommand::class,
        ProjectsObjectStoragesShowCommand::class,
        ProjectsObjectStoragesStoreCommand::class,
        ProjectsOverviewCommand::class,
        ProjectsPlanShowCommand::class,
        ProjectsPlanUpdateCommand::class,
        ProjectsPlanUsageCommand::class,
        ProjectsServicesBackupsCommand::class,
        ProjectsServicesBindingsCommand::class,
        ProjectsServicesBindingsDestroyCommand::class,
        ProjectsServicesBindingsStoreCommand::class,
        ProjectsServicesConfigurationCommand::class,
        ProjectsServicesDestroyCommand::class,
        ProjectsServicesIndexCommand::class,
        ProjectsServicesShowCommand::class,
        ProjectsServicesStoreCommand::class,
        ProjectsServicesUpdateCommand::class,
        ProjectsSettingsShowCommand::class,
        ProjectsSettingsUpdateCommand::class,
        ProjectsSshKeysDestroyCommand::class,
        ProjectsSshKeysIndexCommand::class,
        ProjectsSshKeysStoreCommand::class,
        ProjectsStoragesFileContentsShowCommand::class,
        ProjectsStoragesFileContentsUpdateCommand::class,
        ProjectsStoragesFilesDestroyCommand::class,
        ProjectsStoragesFilesDownloadCommand::class,
        ProjectsStoragesFilesIndexCommand::class,
        ProjectsStoragesFilesStoreCommand::class,
        ProjectsStoreCommand::class,
        ProjectsUpdateCommand::class,
    ];

    /** @return list<class-string<Command>> */
    public static function all(): array
    {
        return self::COMMANDS;
    }
}
