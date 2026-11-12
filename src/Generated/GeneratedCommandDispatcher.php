<?php

declare(strict_types=1);

namespace Vented\Generated;

use Vented\Data\AppLifecycleData;
use Vented\Data\BindPaymentMethodData;
use Vented\Data\CancelSubscriptionData;
use Vented\Data\CommitQuoteData;
use Vented\Data\CreateQuoteData;
use Vented\Data\StoreApiTokenData;
use Vented\Data\StoreAppBindingData;
use Vented\Data\StoreAppData;
use Vented\Data\StoreBackupData;
use Vented\Data\StoreBindingData;
use Vented\Data\StoreBlockStorageData;
use Vented\Data\StoreDeployData;
use Vented\Data\StoreDeployTriggerData;
use Vented\Data\StoreEnvironmentSshKeyData;
use Vented\Data\StoreFileData;
use Vented\Data\StoreFileUploadData;
use Vented\Data\StoreIntegrationData;
use Vented\Data\StoreInviteData;
use Vented\Data\StoreManagedStackCandidatesData;
use Vented\Data\StoreManagedStackData;
use Vented\Data\StoreManagedStackOperationData;
use Vented\Data\StoreObjectStorageData;
use Vented\Data\StoreOrganizationData;
use Vented\Data\StoreOrganizationInviteData;
use Vented\Data\StoreProjectData;
use Vented\Data\StoreRecordData;
use Vented\Data\StoreServiceData;
use Vented\Data\StoreTunnelData;
use Vented\Data\StoreZoneData;
use Vented\Data\TransferOrganizationData;
use Vented\Data\UpdateAppBindingData;
use Vented\Data\UpdateAppData;
use Vented\Data\UpdateBackupSettingsData;
use Vented\Data\UpdateBindingPurposeData;
use Vented\Data\UpdateDeployTriggerData;
use Vented\Data\UpdateFileContentData;
use Vented\Data\UpdateFileData;
use Vented\Data\UpdateFileUploadData;
use Vented\Data\UpdateFlowData;
use Vented\Data\UpdateIntegrationData;
use Vented\Data\UpdateManagedStackData;
use Vented\Data\UpdateManagedStackOperationData;
use Vented\Data\UpdateOnboardingData;
use Vented\Data\UpdateOrganizationData;
use Vented\Data\UpdateOrganizationMemberData;
use Vented\Data\UpdateProjectMemberData;
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
            'account.flows.destroy' => $client->flows()->delete(
                flow: self::stringPath($path, 'flow'),
                query: $query,
            ),
            'account.flows.runs.store' => $client->flowRuns()->create(
                flow: self::stringPath($path, 'flow'),
                query: $query,
            ),
            'account.flows.show' => $client->flows()->find(
                flow: self::stringPath($path, 'flow'),
                query: $query,
            ),
            'account.flows.update' => $client->flows()->update(
                flow: self::stringPath($path, 'flow'),
                data: UpdateFlowData::fromArray($data),
                query: $query,
            ),
            'account.getting-started.show' => $client->gettingStarted()->find(
                query: $query,
            ),
            'account.getting-started.update' => $client->gettingStarted()->update(
                data: UpdateOnboardingData::fromArray($data),
                query: $query,
            ),
            'account.organizations.destroy' => $client->organizations()->delete(
                organization: self::stringPath($path, 'organization'),
                query: $query,
            ),
            'account.organizations.index' => $client->organizations()->list(
                query: $query,
            ),
            'account.organizations.invitations.destroy' => $client->organizationInvitations()->delete(
                organization: self::stringPath($path, 'organization'),
                invitation: self::stringPath($path, 'invitation'),
                query: $query,
            ),
            'account.organizations.invitations.store' => $client->organizationInvitations()->create(
                organization: self::stringPath($path, 'organization'),
                data: StoreOrganizationInviteData::fromArray($data),
                query: $query,
            ),
            'account.organizations.members.destroy' => $client->organizationMembers()->delete(
                organization: self::stringPath($path, 'organization'),
                member: self::stringPath($path, 'member'),
                query: $query,
            ),
            'account.organizations.members.index' => $client->organizationMembers()->list(
                organization: self::stringPath($path, 'organization'),
                query: $query,
            ),
            'account.organizations.members.update' => $client->organizationMembers()->update(
                organization: self::stringPath($path, 'organization'),
                member: self::stringPath($path, 'member'),
                data: UpdateOrganizationMemberData::fromArray($data),
                query: $query,
            ),
            'account.organizations.settings' => $client->organizationSettings()->list(
                organization: self::stringPath($path, 'organization'),
                query: $query,
            ),
            'account.organizations.show' => $client->organizations()->find(
                organization: self::stringPath($path, 'organization'),
                query: $query,
            ),
            'account.organizations.store' => $client->organizations()->create(
                data: StoreOrganizationData::fromArray($data),
                query: $query,
            ),
            'account.organizations.transfer' => $client->organizations()->transfer(
                organization: self::stringPath($path, 'organization'),
                data: TransferOrganizationData::fromArray($data),
                query: $query,
            ),
            'account.organizations.transfer.accept' => $client->organizationTransfer()->accept(
                organization: self::stringPath($path, 'organization'),
                query: $query,
            ),
            'account.organizations.transfer.cancel' => $client->organizationTransfer()->cancel(
                organization: self::stringPath($path, 'organization'),
                query: $query,
            ),
            'account.organizations.update' => $client->organizations()->update(
                organization: self::stringPath($path, 'organization'),
                data: UpdateOrganizationData::fromArray($data),
                query: $query,
            ),
            'platform-locations.index' => $client->platformLocations()->list(
                query: $query,
            ),
            'projects.apps.bindings' => $client->appBindings()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                app: self::stringPath($path, 'app'),
                query: $query,
            ),
            'projects.apps.bindings.destroy' => $client->appBindings()->delete(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                app: self::stringPath($path, 'app'),
                binding: self::stringPath($path, 'binding'),
                query: $query,
            ),
            'projects.apps.bindings.rotate' => $client->appBindings()->rotate(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                app: self::stringPath($path, 'app'),
                binding: self::stringPath($path, 'binding'),
                query: $query,
            ),
            'projects.apps.bindings.store' => $client->appBindings()->create(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                app: self::stringPath($path, 'app'),
                data: StoreBindingData::fromArray($data),
                query: $query,
            ),
            'projects.apps.bindings.update' => $client->appBindings()->update(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                app: self::stringPath($path, 'app'),
                binding: self::stringPath($path, 'binding'),
                data: UpdateBindingPurposeData::fromArray($data),
                query: $query,
            ),
            'projects.apps.configuration' => $client->apps()->configuration(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                app: self::stringPath($path, 'app'),
                query: $query,
            ),
            'projects.apps.deploy' => $client->appDeploy()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                app: self::stringPath($path, 'app'),
                query: $query,
            ),
            'projects.apps.destroy' => $client->apps()->delete(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                app: self::stringPath($path, 'app'),
                query: $query,
            ),
            'projects.apps.domains' => $client->appDomains()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                app: self::stringPath($path, 'app'),
                query: $query,
            ),
            'projects.apps.index' => $client->apps()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                query: $query,
            ),
            'projects.apps.logs' => $client->appLogs()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                app: self::stringPath($path, 'app'),
                query: $query,
            ),
            'projects.apps.restart' => $client->apps()->restart(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                app: self::stringPath($path, 'app'),
                data: AppLifecycleData::fromArray($data),
                query: $query,
            ),
            'projects.apps.setup' => $client->apps()->setup(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                app: self::stringPath($path, 'app'),
                query: $query,
            ),
            'projects.apps.show' => $client->apps()->find(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                app: self::stringPath($path, 'app'),
                query: $query,
            ),
            'projects.apps.start' => $client->apps()->start(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                app: self::stringPath($path, 'app'),
                data: AppLifecycleData::fromArray($data),
                query: $query,
            ),
            'projects.apps.stop' => $client->apps()->stop(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                app: self::stringPath($path, 'app'),
                data: AppLifecycleData::fromArray($data),
                query: $query,
            ),
            'projects.apps.storage' => $client->apps()->storage(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                app: self::stringPath($path, 'app'),
                query: $query,
            ),
            'projects.apps.store' => $client->apps()->create(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                data: StoreAppData::fromArray($data),
                query: $query,
            ),
            'projects.apps.terminal' => $client->apps()->terminal(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                app: self::stringPath($path, 'app'),
                query: $query,
            ),
            'projects.apps.update' => $client->apps()->update(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                app: self::stringPath($path, 'app'),
                data: UpdateAppData::fromArray($data),
                query: $query,
            ),
            'projects.backup-settings.show' => $client->backupSettings()->find(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                query: $query,
            ),
            'projects.backup-settings.update' => $client->backupSettings()->update(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                data: UpdateBackupSettingsData::fromArray($data),
                query: $query,
            ),
            'projects.backups.destroy' => $client->backups()->delete(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                backup: self::stringPath($path, 'backup'),
                query: $query,
            ),
            'projects.backups.index' => $client->backups()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                query: $query,
            ),
            'projects.backups.store' => $client->backups()->create(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                data: StoreBackupData::fromArray($data),
                query: $query,
            ),
            'projects.billing.cancellations.store' => $client->billingCancellations()->create(
                project: self::stringPath($path, 'project'),
                data: CancelSubscriptionData::fromArray($data),
                query: $query,
            ),
            'projects.billing.changes.store' => $client->billingChanges()->create(
                project: self::stringPath($path, 'project'),
                data: CommitQuoteData::fromArray($data),
                query: $query,
            ),
            'projects.billing.invoices.confirmations.store' => $client->billingInvoiceConfirmations()->create(
                project: self::stringPath($path, 'project'),
                invoice: self::stringPath($path, 'invoice'),
                query: $query,
            ),
            'projects.billing.invoices.download' => $client->billingInvoices()->download(
                project: self::stringPath($path, 'project'),
                invoice: self::stringPath($path, 'invoice'),
                query: $query,
            ),
            'projects.billing.invoices.show' => $client->billingInvoices()->find(
                project: self::stringPath($path, 'project'),
                invoice: self::stringPath($path, 'invoice'),
                query: $query,
            ),
            'projects.billing.operations.confirmations.store' => $client->billingOperationConfirmations()->create(
                project: self::stringPath($path, 'project'),
                operation: self::stringPath($path, 'operation'),
                query: $query,
            ),
            'projects.billing.operations.show' => $client->billingOperations()->find(
                project: self::stringPath($path, 'project'),
                operation: self::stringPath($path, 'operation'),
                query: $query,
            ),
            'projects.billing.payment-methods.store' => $client->billingPaymentMethods()->create(
                project: self::stringPath($path, 'project'),
                data: BindPaymentMethodData::fromArray($data),
                query: $query,
            ),
            'projects.billing.quotes.store' => $client->billingQuotes()->create(
                project: self::stringPath($path, 'project'),
                data: CreateQuoteData::fromArray($data),
                query: $query,
            ),
            'projects.billing.setup-intents.store' => $client->billingSetupIntents()->create(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.billing.show' => $client->billing()->find(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.block-storages.backups' => $client->blockStorageBackups()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                storage: self::stringPath($path, 'storage'),
                query: $query,
            ),
            'projects.block-storages.destroy' => $client->blockStorages()->delete(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                storage: self::stringPath($path, 'storage'),
                query: $query,
            ),
            'projects.block-storages.index' => $client->blockStorages()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                query: $query,
            ),
            'projects.block-storages.show' => $client->blockStorages()->find(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                storage: self::stringPath($path, 'storage'),
                query: $query,
            ),
            'projects.block-storages.store' => $client->blockStorages()->create(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                data: StoreBlockStorageData::fromArray($data),
                query: $query,
            ),
            'projects.deploy-triggers.destroy' => $client->deployTriggers()->delete(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                deployTrigger: self::stringPath($path, 'deployTrigger'),
                query: $query,
            ),
            'projects.deploy-triggers.index' => $client->deployTriggers()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                query: $query,
            ),
            'projects.deploy-triggers.store' => $client->deployTriggers()->create(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                data: StoreDeployTriggerData::fromArray($data),
                query: $query,
            ),
            'projects.deploy-triggers.update' => $client->deployTriggers()->update(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                deployTrigger: self::stringPath($path, 'deployTrigger'),
                data: UpdateDeployTriggerData::fromArray($data),
                query: $query,
            ),
            'projects.deploys.index' => $client->deploys()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                query: $query,
            ),
            'projects.deploys.store' => $client->deploys()->create(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                data: StoreDeployData::fromArray($data),
                query: $query,
            ),
            'projects.destroy' => $client->projects()->delete(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.developers.index' => $client->developers()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
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
            'projects.members.update' => $client->members()->update(
                project: self::stringPath($path, 'project'),
                member: self::stringPath($path, 'member'),
                data: UpdateProjectMemberData::fromArray($data),
                query: $query,
            ),
            'projects.object-storages.backups' => $client->objectStorageBackups()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                storage: self::stringPath($path, 'storage'),
                query: $query,
            ),
            'projects.object-storages.destroy' => $client->objectStorages()->delete(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                storage: self::stringPath($path, 'storage'),
                query: $query,
            ),
            'projects.object-storages.index' => $client->objectStorages()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                query: $query,
            ),
            'projects.object-storages.show' => $client->objectStorages()->find(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                storage: self::stringPath($path, 'storage'),
                query: $query,
            ),
            'projects.object-storages.store' => $client->objectStorages()->create(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                data: StoreObjectStorageData::fromArray($data),
                query: $query,
            ),
            'projects.overview' => $client->projects()->find(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.pin.destroy' => $client->projectPins()->delete(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.pin.store' => $client->projectPins()->create(
                project: self::stringPath($path, 'project'),
                query: $query,
            ),
            'projects.services.backups' => $client->serviceBackups()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                service: self::stringPath($path, 'service'),
                query: $query,
            ),
            'projects.services.bindings' => $client->serviceBindings()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                service: self::stringPath($path, 'service'),
                query: $query,
            ),
            'projects.services.bindings.destroy' => $client->serviceBindings()->delete(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                service: self::stringPath($path, 'service'),
                binding: self::stringPath($path, 'binding'),
                query: $query,
            ),
            'projects.services.bindings.outputs' => $client->serviceBindingOutputs()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                service: self::stringPath($path, 'service'),
                binding: self::stringPath($path, 'binding'),
                query: $query,
            ),
            'projects.services.bindings.rotate' => $client->serviceBindings()->rotate(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                service: self::stringPath($path, 'service'),
                binding: self::stringPath($path, 'binding'),
                query: $query,
            ),
            'projects.services.bindings.store' => $client->serviceBindings()->create(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                service: self::stringPath($path, 'service'),
                data: StoreBindingData::fromArray($data),
                query: $query,
            ),
            'projects.services.bindings.update' => $client->serviceBindings()->update(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                service: self::stringPath($path, 'service'),
                binding: self::stringPath($path, 'binding'),
                data: UpdateBindingPurposeData::fromArray($data),
                query: $query,
            ),
            'projects.services.configuration' => $client->services()->configuration(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                service: self::stringPath($path, 'service'),
                query: $query,
            ),
            'projects.services.destroy' => $client->services()->delete(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                service: self::stringPath($path, 'service'),
                query: $query,
            ),
            'projects.services.index' => $client->services()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                query: $query,
            ),
            'projects.services.outputs' => $client->services()->outputs(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                service: self::stringPath($path, 'service'),
                query: $query,
            ),
            'projects.services.show' => $client->services()->find(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                service: self::stringPath($path, 'service'),
                query: $query,
            ),
            'projects.services.store' => $client->services()->create(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                data: StoreServiceData::fromArray($data),
                query: $query,
            ),
            'projects.services.update' => $client->services()->update(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
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
                environment: self::stringPath($path, 'environment'),
                sshKey: self::stringPath($path, 'sshKey'),
                query: $query,
            ),
            'projects.ssh-keys.index' => $client->sshKeys()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                query: $query,
            ),
            'projects.ssh-keys.store' => $client->sshKeys()->create(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                data: StoreEnvironmentSshKeyData::fromArray($data),
                query: $query,
            ),
            'projects.stack-candidates.store' => $client->stackCandidates()->create(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                data: StoreManagedStackCandidatesData::fromArray($data),
                query: $query,
            ),
            'projects.stack-operations.store' => $client->stackOperations()->create(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                data: StoreManagedStackOperationData::fromArray($data),
                query: $query,
            ),
            'projects.stack-operations.update' => $client->stackOperations()->update(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                operation: self::stringPath($path, 'operation'),
                data: UpdateManagedStackOperationData::fromArray($data),
                query: $query,
            ),
            'projects.stacks.destroy' => $client->stacks()->delete(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                stack: self::stringPath($path, 'stack'),
                query: $query,
            ),
            'projects.stacks.index' => $client->stacks()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                query: $query,
            ),
            'projects.stacks.show' => $client->stacks()->find(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                stack: self::stringPath($path, 'stack'),
                query: $query,
            ),
            'projects.stacks.store' => $client->stacks()->create(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                data: StoreManagedStackData::fromArray($data),
                query: $query,
            ),
            'projects.stacks.update' => $client->stacks()->update(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                stack: self::stringPath($path, 'stack'),
                data: UpdateManagedStackData::fromArray($data),
                query: $query,
            ),
            'projects.storages.file-contents.show' => $client->storageFileContents()->find(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                storage: self::stringPath($path, 'storage'),
                file: self::stringPath($path, 'file'),
                query: $query,
            ),
            'projects.storages.file-contents.update' => $client->storageFileContents()->update(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                storage: self::stringPath($path, 'storage'),
                file: self::stringPath($path, 'file'),
                data: UpdateFileContentData::fromArray($data),
                query: $query,
            ),
            'projects.storages.file-trees.index' => $client->storageFileTrees()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                storage: self::stringPath($path, 'storage'),
                query: $query,
            ),
            'projects.storages.file-uploads.destroy' => $client->storageFileUploads()->delete(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                storage: self::stringPath($path, 'storage'),
                upload: self::stringPath($path, 'upload'),
                query: $query,
            ),
            'projects.storages.file-uploads.parts.update' => $client->storageFileUploadParts()->update(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                storage: self::stringPath($path, 'storage'),
                upload: self::stringPath($path, 'upload'),
                part: self::stringPath($path, 'part'),
                query: $query,
            ),
            'projects.storages.file-uploads.show' => $client->storageFileUploads()->find(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                storage: self::stringPath($path, 'storage'),
                upload: self::stringPath($path, 'upload'),
                query: $query,
            ),
            'projects.storages.file-uploads.store' => $client->storageFileUploads()->create(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                storage: self::stringPath($path, 'storage'),
                data: StoreFileUploadData::fromArray($data),
                query: $query,
            ),
            'projects.storages.file-uploads.update' => $client->storageFileUploads()->update(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                storage: self::stringPath($path, 'storage'),
                upload: self::stringPath($path, 'upload'),
                data: UpdateFileUploadData::fromArray($data),
                query: $query,
            ),
            'projects.storages.files.destroy' => $client->storageFiles()->delete(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                storage: self::stringPath($path, 'storage'),
                file: self::stringPath($path, 'file'),
                query: $query,
            ),
            'projects.storages.files.download' => $client->storageFiles()->download(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                storage: self::stringPath($path, 'storage'),
                file: self::stringPath($path, 'file'),
                query: $query,
            ),
            'projects.storages.files.index' => $client->storageFiles()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                storage: self::stringPath($path, 'storage'),
                query: $query,
            ),
            'projects.storages.files.show' => $client->storageFiles()->find(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                storage: self::stringPath($path, 'storage'),
                file: self::stringPath($path, 'file'),
                query: $query,
            ),
            'projects.storages.files.store' => $client->storageFiles()->create(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                storage: self::stringPath($path, 'storage'),
                data: StoreFileData::fromArray($data),
                query: $query,
            ),
            'projects.storages.files.update' => $client->storageFiles()->update(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                storage: self::stringPath($path, 'storage'),
                file: self::stringPath($path, 'file'),
                data: UpdateFileData::fromArray($data),
                query: $query,
            ),
            'projects.store' => $client->projects()->create(
                data: StoreProjectData::fromArray($data),
                query: $query,
            ),
            'projects.tunnels.agent-setup' => $client->tunnels()->agentSetup(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                query: $query,
            ),
            'projects.tunnels.destroy' => $client->tunnels()->delete(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                tunnel: self::stringPath($path, 'tunnel'),
                query: $query,
            ),
            'projects.tunnels.index' => $client->tunnels()->list(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                query: $query,
            ),
            'projects.tunnels.show' => $client->tunnels()->find(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                tunnel: self::stringPath($path, 'tunnel'),
                query: $query,
            ),
            'projects.tunnels.start' => $client->tunnels()->start(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                tunnel: self::stringPath($path, 'tunnel'),
                query: $query,
            ),
            'projects.tunnels.stop' => $client->tunnels()->stop(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                tunnel: self::stringPath($path, 'tunnel'),
                query: $query,
            ),
            'projects.tunnels.store' => $client->tunnels()->create(
                project: self::stringPath($path, 'project'),
                environment: self::stringPath($path, 'environment'),
                data: StoreTunnelData::fromArray($data),
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
