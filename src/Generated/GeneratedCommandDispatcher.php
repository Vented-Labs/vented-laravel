<?php

declare(strict_types=1);

namespace Vented\Generated;

use Vented\Data\SelectPlanData;
use Vented\Data\StoreApiTokenData;
use Vented\Data\StoreAppBindingData;
use Vented\Data\StoreAppData;
use Vented\Data\StoreBackupData;
use Vented\Data\StoreBindingData;
use Vented\Data\StoreBlockStorageData;
use Vented\Data\StoreDeployData;
use Vented\Data\StoreDeployTriggerData;
use Vented\Data\StoreFileData;
use Vented\Data\StoreIntegrationData;
use Vented\Data\StoreInviteData;
use Vented\Data\StoreObjectStorageData;
use Vented\Data\StoreProjectData;
use Vented\Data\StoreProjectSshKeyData;
use Vented\Data\StoreRecordData;
use Vented\Data\StoreServiceData;
use Vented\Data\StoreZoneData;
use Vented\Data\UpdateAppBindingData;
use Vented\Data\UpdateAppData;
use Vented\Data\UpdateBackupSettingsData;
use Vented\Data\UpdateDeployTriggerData;
use Vented\Data\UpdateFileContentData;
use Vented\Data\UpdateIntegrationData;
use Vented\Data\UpdateProjectData;
use Vented\Data\UpdateProjectSettingsData;
use Vented\Data\UpdateRecordData;
use Vented\Data\UpdateServiceData;
use Vented\Data\UpdateZoneData;
use Vented\Results\BinaryResult;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\PaginatedResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final class GeneratedCommandDispatcher
{
    /**
     * @param  array<string, string>  $path
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $query
     * @return ResourceResult<mixed>|CollectionResult<mixed>|PaginatedResult<mixed>|NoContentResult|BinaryResult
     */
    public static function dispatch(string $operationId, Vented $client, array $path, array $data, array $query): ResourceResult|CollectionResult|PaginatedResult|NoContentResult|BinaryResult
    {
        return match ($operationId) {
            'account.api-tokens.destroy' => $client->apiTokens()->delete(
                token: self::stringPath($path, 'token'),
                query: $query,
            ),
            'account.api-tokens.index' => $client->apiTokens()->list(
                query: $query,
            ),
            'account.api-tokens.store' => $client->apiTokens()->create(
                data: StoreApiTokenData::fromArray($data),
                query: $query,
            ),
            'platform-locations.index' => $client->platformLocations()->list(
                query: $query,
            ),
            'projects.apps.bindings' => $client->appBindings()->list(
                project: self::stringPath($path, 'project'),
                app: self::stringPath($path, 'app'),
                query: $query,
            ),
            'projects.apps.bindings.destroy' => $client->appBindings()->delete(
                project: self::stringPath($path, 'project'),
                app: self::stringPath($path, 'app'),
                binding: self::stringPath($path, 'binding'),
                query: $query,
            ),
            'projects.apps.bindings.store' => $client->appBindings()->create(
                project: self::stringPath($path, 'project'),
                app: self::stringPath($path, 'app'),
                data: StoreBindingData::fromArray($data),
                query: $query,
            ),
            'projects.apps.configuration' => $client->apps()->configuration(
                project: self::stringPath($path, 'project'),
                app: self::stringPath($path, 'app'),
                query: $query,
            ),
            'projects.apps.deploy' => $client->appDeploy()->list(
                project: self::stringPath($path, 'project'),
                app: self::stringPath($path, 'app'),
                query: $query,
            ),
            'projects.apps.destroy' => $client->apps()->delete(
                project: self::stringPath($path, 'project'),
                app: self::stringPath($path, 'app'),
                query: $query,
            ),
            'projects.apps.domains' => $client->appDomains()->list(
                project: self::stringPath($path, 'project'),
                app: self::stringPath($path, 'app'),
                query: $query,
            ),
            'projects.apps.index' => $client->apps()->list(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.apps.restart' => $client->apps()->restart(
                project: self::stringPath($path, 'project'),
                app: self::stringPath($path, 'app'),
                query: $query,
            ),
            'projects.apps.show' => $client->apps()->find(
                project: self::stringPath($path, 'project'),
                app: self::stringPath($path, 'app'),
                query: $query,
            ),
            'projects.apps.start' => $client->apps()->start(
                project: self::stringPath($path, 'project'),
                app: self::stringPath($path, 'app'),
                query: $query,
            ),
            'projects.apps.stop' => $client->apps()->stop(
                project: self::stringPath($path, 'project'),
                app: self::stringPath($path, 'app'),
                query: $query,
            ),
            'projects.apps.storage' => $client->apps()->storage(
                project: self::stringPath($path, 'project'),
                app: self::stringPath($path, 'app'),
                query: $query,
            ),
            'projects.apps.store' => $client->apps()->create(
                project: self::stringPath($path, 'project'),
                data: StoreAppData::fromArray($data),
                query: $query,
            ),
            'projects.apps.update' => $client->apps()->update(
                project: self::stringPath($path, 'project'),
                app: self::stringPath($path, 'app'),
                data: UpdateAppData::fromArray($data),
                query: $query,
            ),
            'projects.backup-settings.show' => $client->backupSettings()->find(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.backup-settings.update' => $client->backupSettings()->update(
                project: self::stringPath($path, 'project'),
                data: UpdateBackupSettingsData::fromArray($data),
                query: $query,
            ),
            'projects.backups.destroy' => $client->backups()->delete(
                project: self::stringPath($path, 'project'),
                backup: self::stringPath($path, 'backup'),
                query: $query,
            ),
            'projects.backups.index' => $client->backups()->list(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.backups.store' => $client->backups()->create(
                project: self::stringPath($path, 'project'),
                data: StoreBackupData::fromArray($data),
                query: $query,
            ),
            'projects.block-storages.backups' => $client->blockStorageBackups()->list(
                project: self::stringPath($path, 'project'),
                storage: self::stringPath($path, 'storage'),
                query: $query,
            ),
            'projects.block-storages.destroy' => $client->blockStorages()->delete(
                project: self::stringPath($path, 'project'),
                storage: self::stringPath($path, 'storage'),
                query: $query,
            ),
            'projects.block-storages.index' => $client->blockStorages()->list(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.block-storages.show' => $client->blockStorages()->find(
                project: self::stringPath($path, 'project'),
                storage: self::stringPath($path, 'storage'),
                query: $query,
            ),
            'projects.block-storages.store' => $client->blockStorages()->create(
                project: self::stringPath($path, 'project'),
                data: StoreBlockStorageData::fromArray($data),
                query: $query,
            ),
            'projects.deploy-triggers.destroy' => $client->deployTriggers()->delete(
                project: self::stringPath($path, 'project'),
                deployTrigger: self::stringPath($path, 'deployTrigger'),
                query: $query,
            ),
            'projects.deploy-triggers.index' => $client->deployTriggers()->list(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.deploy-triggers.store' => $client->deployTriggers()->create(
                project: self::stringPath($path, 'project'),
                data: StoreDeployTriggerData::fromArray($data),
                query: $query,
            ),
            'projects.deploy-triggers.update' => $client->deployTriggers()->update(
                project: self::stringPath($path, 'project'),
                deployTrigger: self::stringPath($path, 'deployTrigger'),
                data: UpdateDeployTriggerData::fromArray($data),
                query: $query,
            ),
            'projects.deploys.index' => $client->deploys()->list(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.deploys.store' => $client->deploys()->create(
                project: self::stringPath($path, 'project'),
                data: StoreDeployData::fromArray($data),
                query: $query,
            ),
            'projects.deploys.templates.index' => $client->deployTemplates()->list(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.destroy' => $client->projects()->delete(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.developers.index' => $client->developers()->list(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.dns.zones.bindings.destroy' => $client->dnsZoneBindings()->delete(
                project: self::stringPath($path, 'project'),
                zone: self::stringPath($path, 'zone'),
                binding: self::stringPath($path, 'binding'),
                query: $query,
            ),
            'projects.dns.zones.bindings.index' => $client->dnsZoneBindings()->list(
                project: self::stringPath($path, 'project'),
                zone: self::stringPath($path, 'zone'),
                query: $query,
            ),
            'projects.dns.zones.bindings.store' => $client->dnsZoneBindings()->create(
                project: self::stringPath($path, 'project'),
                zone: self::stringPath($path, 'zone'),
                data: StoreAppBindingData::fromArray($data),
                query: $query,
            ),
            'projects.dns.zones.bindings.update' => $client->dnsZoneBindings()->update(
                project: self::stringPath($path, 'project'),
                zone: self::stringPath($path, 'zone'),
                binding: self::stringPath($path, 'binding'),
                data: UpdateAppBindingData::fromArray($data),
                query: $query,
            ),
            'projects.dns.zones.destroy' => $client->dnsZones()->delete(
                project: self::stringPath($path, 'project'),
                zone: self::stringPath($path, 'zone'),
                query: $query,
            ),
            'projects.dns.zones.export' => $client->dnsZones()->export(
                project: self::stringPath($path, 'project'),
                zone: self::stringPath($path, 'zone'),
                query: $query,
            ),
            'projects.dns.zones.index' => $client->dnsZones()->list(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.dns.zones.records.destroy' => $client->dnsZoneRecords()->delete(
                project: self::stringPath($path, 'project'),
                zone: self::stringPath($path, 'zone'),
                record: self::stringPath($path, 'record'),
                query: $query,
            ),
            'projects.dns.zones.records.index' => $client->dnsZoneRecords()->list(
                project: self::stringPath($path, 'project'),
                zone: self::stringPath($path, 'zone'),
                query: $query,
            ),
            'projects.dns.zones.records.store' => $client->dnsZoneRecords()->create(
                project: self::stringPath($path, 'project'),
                zone: self::stringPath($path, 'zone'),
                data: StoreRecordData::fromArray($data),
                query: $query,
            ),
            'projects.dns.zones.records.update' => $client->dnsZoneRecords()->update(
                project: self::stringPath($path, 'project'),
                zone: self::stringPath($path, 'zone'),
                record: self::stringPath($path, 'record'),
                data: UpdateRecordData::fromArray($data),
                query: $query,
            ),
            'projects.dns.zones.show' => $client->dnsZones()->find(
                project: self::stringPath($path, 'project'),
                zone: self::stringPath($path, 'zone'),
                query: $query,
            ),
            'projects.dns.zones.status' => $client->dnsZones()->status(
                project: self::stringPath($path, 'project'),
                zone: self::stringPath($path, 'zone'),
                query: $query,
            ),
            'projects.dns.zones.store' => $client->dnsZones()->create(
                project: self::stringPath($path, 'project'),
                data: StoreZoneData::fromArray($data),
                query: $query,
            ),
            'projects.dns.zones.update' => $client->dnsZones()->update(
                project: self::stringPath($path, 'project'),
                zone: self::stringPath($path, 'zone'),
                data: UpdateZoneData::fromArray($data),
                query: $query,
            ),
            'projects.index' => $client->projects()->list(
                query: $query,
            ),
            'projects.integrations.destroy' => $client->integrations()->delete(
                project: self::stringPath($path, 'project'),
                integration: self::stringPath($path, 'integration'),
                query: $query,
            ),
            'projects.integrations.index' => $client->integrations()->list(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.integrations.show' => $client->integrations()->find(
                project: self::stringPath($path, 'project'),
                integration: self::stringPath($path, 'integration'),
                query: $query,
            ),
            'projects.integrations.store' => $client->integrations()->create(
                project: self::stringPath($path, 'project'),
                data: StoreIntegrationData::fromArray($data),
                query: $query,
            ),
            'projects.integrations.update' => $client->integrations()->update(
                project: self::stringPath($path, 'project'),
                integration: self::stringPath($path, 'integration'),
                data: UpdateIntegrationData::fromArray($data),
                query: $query,
            ),
            'projects.members.destroy' => $client->members()->delete(
                project: self::stringPath($path, 'project'),
                member: self::stringPath($path, 'member'),
                query: $query,
            ),
            'projects.members.index' => $client->members()->list(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.members.invitations.destroy' => $client->memberInvitations()->delete(
                project: self::stringPath($path, 'project'),
                invitation: self::stringPath($path, 'invitation'),
                query: $query,
            ),
            'projects.members.invitations.index' => $client->memberInvitations()->list(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.members.invitations.store' => $client->memberInvitations()->create(
                project: self::stringPath($path, 'project'),
                data: StoreInviteData::fromArray($data),
                query: $query,
            ),
            'projects.object-storages.backups' => $client->objectStorageBackups()->list(
                project: self::stringPath($path, 'project'),
                storage: self::stringPath($path, 'storage'),
                query: $query,
            ),
            'projects.object-storages.destroy' => $client->objectStorages()->delete(
                project: self::stringPath($path, 'project'),
                storage: self::stringPath($path, 'storage'),
                query: $query,
            ),
            'projects.object-storages.index' => $client->objectStorages()->list(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.object-storages.show' => $client->objectStorages()->find(
                project: self::stringPath($path, 'project'),
                storage: self::stringPath($path, 'storage'),
                query: $query,
            ),
            'projects.object-storages.store' => $client->objectStorages()->create(
                project: self::stringPath($path, 'project'),
                data: StoreObjectStorageData::fromArray($data),
                query: $query,
            ),
            'projects.overview' => $client->projects()->find(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.plan.show' => $client->plan()->find(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.plan.update' => $client->plan()->update(
                project: self::stringPath($path, 'project'),
                data: SelectPlanData::fromArray($data),
                query: $query,
            ),
            'projects.plan.usage' => $client->plan()->usage(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.services.backups' => $client->serviceBackups()->list(
                project: self::stringPath($path, 'project'),
                service: self::stringPath($path, 'service'),
                query: $query,
            ),
            'projects.services.bindings' => $client->serviceBindings()->list(
                project: self::stringPath($path, 'project'),
                service: self::stringPath($path, 'service'),
                query: $query,
            ),
            'projects.services.bindings.destroy' => $client->serviceBindings()->delete(
                project: self::stringPath($path, 'project'),
                service: self::stringPath($path, 'service'),
                binding: self::stringPath($path, 'binding'),
                query: $query,
            ),
            'projects.services.bindings.store' => $client->serviceBindings()->create(
                project: self::stringPath($path, 'project'),
                service: self::stringPath($path, 'service'),
                data: StoreBindingData::fromArray($data),
                query: $query,
            ),
            'projects.services.configuration' => $client->services()->configuration(
                project: self::stringPath($path, 'project'),
                service: self::stringPath($path, 'service'),
                query: $query,
            ),
            'projects.services.destroy' => $client->services()->delete(
                project: self::stringPath($path, 'project'),
                service: self::stringPath($path, 'service'),
                query: $query,
            ),
            'projects.services.index' => $client->services()->list(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.services.show' => $client->services()->find(
                project: self::stringPath($path, 'project'),
                service: self::stringPath($path, 'service'),
                query: $query,
            ),
            'projects.services.store' => $client->services()->create(
                project: self::stringPath($path, 'project'),
                data: StoreServiceData::fromArray($data),
                query: $query,
            ),
            'projects.services.update' => $client->services()->update(
                project: self::stringPath($path, 'project'),
                service: self::stringPath($path, 'service'),
                data: UpdateServiceData::fromArray($data),
                query: $query,
            ),
            'projects.settings.show' => $client->settings()->find(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.settings.update' => $client->settings()->update(
                project: self::stringPath($path, 'project'),
                data: UpdateProjectSettingsData::fromArray($data),
                query: $query,
            ),
            'projects.ssh-keys.destroy' => $client->sshKeys()->delete(
                project: self::stringPath($path, 'project'),
                sshKey: self::stringPath($path, 'sshKey'),
                query: $query,
            ),
            'projects.ssh-keys.index' => $client->sshKeys()->list(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.ssh-keys.store' => $client->sshKeys()->create(
                project: self::stringPath($path, 'project'),
                data: StoreProjectSshKeyData::fromArray($data),
                query: $query,
            ),
            'projects.storages.file-contents.show' => $client->storageFileContents()->find(
                project: self::stringPath($path, 'project'),
                storage: self::stringPath($path, 'storage'),
                file: self::stringPath($path, 'file'),
                query: $query,
            ),
            'projects.storages.file-contents.update' => $client->storageFileContents()->update(
                project: self::stringPath($path, 'project'),
                storage: self::stringPath($path, 'storage'),
                file: self::stringPath($path, 'file'),
                data: UpdateFileContentData::fromArray($data),
                query: $query,
            ),
            'projects.storages.files.destroy' => $client->storageFiles()->delete(
                project: self::stringPath($path, 'project'),
                storage: self::stringPath($path, 'storage'),
                file: self::stringPath($path, 'file'),
                query: $query,
            ),
            'projects.storages.files.download' => $client->storageFiles()->download(
                project: self::stringPath($path, 'project'),
                storage: self::stringPath($path, 'storage'),
                file: self::stringPath($path, 'file'),
                query: $query,
            ),
            'projects.storages.files.index' => $client->storageFiles()->list(
                project: self::stringPath($path, 'project'),
                storage: self::stringPath($path, 'storage'),
                query: $query,
            ),
            'projects.storages.files.store' => $client->storageFiles()->create(
                project: self::stringPath($path, 'project'),
                storage: self::stringPath($path, 'storage'),
                data: StoreFileData::fromArray($data),
                query: $query,
            ),
            'projects.store' => $client->projects()->create(
                data: StoreProjectData::fromArray($data),
                query: $query,
            ),
            'projects.update' => $client->projects()->update(
                project: self::stringPath($path, 'project'),
                data: UpdateProjectData::fromArray($data),
                query: $query,
            ),
            default => throw new \InvalidArgumentException("Unknown generated Vented operation [\{$operationId}]."),
        };
    }

    /** @param array<string, string> $path */
    private static function stringPath(array $path, string $name): string
    {
        return $path[$name] ?? throw new \InvalidArgumentException("Missing path parameter [\{$name}].");
    }
}
