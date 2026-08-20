<?php

declare(strict_types=1);

namespace Vented\Generated;

use Vented\Resources\ApiTokensResource;
use Vented\Resources\AppBindingsResource;
use Vented\Resources\AppDeployResource;
use Vented\Resources\AppDomainsResource;
use Vented\Resources\AppsResource;
use Vented\Resources\BackupSettingsResource;
use Vented\Resources\BackupsResource;
use Vented\Resources\BlockStorageBackupsResource;
use Vented\Resources\BlockStoragesResource;
use Vented\Resources\DeploysResource;
use Vented\Resources\DeployTemplatesResource;
use Vented\Resources\DeployTriggersResource;
use Vented\Resources\DevelopersResource;
use Vented\Resources\DnsZoneBindingsResource;
use Vented\Resources\DnsZoneRecordsResource;
use Vented\Resources\DnsZonesResource;
use Vented\Resources\EnvironmentsResource;
use Vented\Resources\EnvironmentTransferPresetsResource;
use Vented\Resources\EnvironmentTransfersResource;
use Vented\Resources\IntegrationsResource;
use Vented\Resources\MemberInvitationsResource;
use Vented\Resources\MembersResource;
use Vented\Resources\ObjectStorageBackupsResource;
use Vented\Resources\ObjectStoragesResource;
use Vented\Resources\PlanResource;
use Vented\Resources\PlatformLocationsResource;
use Vented\Resources\ProjectsResource;
use Vented\Resources\ServiceBackupsResource;
use Vented\Resources\ServiceBindingsResource;
use Vented\Resources\ServicesResource;
use Vented\Resources\SettingsResource;
use Vented\Resources\SshKeysResource;
use Vented\Resources\StorageFileContentsResource;
use Vented\Resources\StorageFilesResource;

trait ResourceAccessors
{
    public function apiTokens(): ApiTokensResource
    {
        return new ApiTokensResource($this);
    }

    public function appBindings(): AppBindingsResource
    {
        return new AppBindingsResource($this);
    }

    public function appDeploy(): AppDeployResource
    {
        return new AppDeployResource($this);
    }

    public function appDomains(): AppDomainsResource
    {
        return new AppDomainsResource($this);
    }

    public function apps(): AppsResource
    {
        return new AppsResource($this);
    }

    public function backupSettings(): BackupSettingsResource
    {
        return new BackupSettingsResource($this);
    }

    public function backups(): BackupsResource
    {
        return new BackupsResource($this);
    }

    public function blockStorageBackups(): BlockStorageBackupsResource
    {
        return new BlockStorageBackupsResource($this);
    }

    public function blockStorages(): BlockStoragesResource
    {
        return new BlockStoragesResource($this);
    }

    public function deployTemplates(): DeployTemplatesResource
    {
        return new DeployTemplatesResource($this);
    }

    public function deployTriggers(): DeployTriggersResource
    {
        return new DeployTriggersResource($this);
    }

    public function deploys(): DeploysResource
    {
        return new DeploysResource($this);
    }

    public function developers(): DevelopersResource
    {
        return new DevelopersResource($this);
    }

    public function dnsZoneBindings(): DnsZoneBindingsResource
    {
        return new DnsZoneBindingsResource($this);
    }

    public function dnsZoneRecords(): DnsZoneRecordsResource
    {
        return new DnsZoneRecordsResource($this);
    }

    public function dnsZones(): DnsZonesResource
    {
        return new DnsZonesResource($this);
    }

    public function environmentTransferPresets(): EnvironmentTransferPresetsResource
    {
        return new EnvironmentTransferPresetsResource($this);
    }

    public function environmentTransfers(): EnvironmentTransfersResource
    {
        return new EnvironmentTransfersResource($this);
    }

    public function environments(): EnvironmentsResource
    {
        return new EnvironmentsResource($this);
    }

    public function integrations(): IntegrationsResource
    {
        return new IntegrationsResource($this);
    }

    public function memberInvitations(): MemberInvitationsResource
    {
        return new MemberInvitationsResource($this);
    }

    public function members(): MembersResource
    {
        return new MembersResource($this);
    }

    public function objectStorageBackups(): ObjectStorageBackupsResource
    {
        return new ObjectStorageBackupsResource($this);
    }

    public function objectStorages(): ObjectStoragesResource
    {
        return new ObjectStoragesResource($this);
    }

    public function plan(): PlanResource
    {
        return new PlanResource($this);
    }

    public function platformLocations(): PlatformLocationsResource
    {
        return new PlatformLocationsResource($this);
    }

    public function projects(): ProjectsResource
    {
        return new ProjectsResource($this);
    }

    public function serviceBackups(): ServiceBackupsResource
    {
        return new ServiceBackupsResource($this);
    }

    public function serviceBindings(): ServiceBindingsResource
    {
        return new ServiceBindingsResource($this);
    }

    public function services(): ServicesResource
    {
        return new ServicesResource($this);
    }

    public function settings(): SettingsResource
    {
        return new SettingsResource($this);
    }

    public function sshKeys(): SshKeysResource
    {
        return new SshKeysResource($this);
    }

    public function storageFileContents(): StorageFileContentsResource
    {
        return new StorageFileContentsResource($this);
    }

    public function storageFiles(): StorageFilesResource
    {
        return new StorageFilesResource($this);
    }
}
