<?php

declare(strict_types=1);

namespace Vented\Generated;

use Vented\Resources\AccountBillingResource;
use Vented\Resources\AccountInvoicesResource;
use Vented\Resources\AccountResource;
use Vented\Resources\AccountSettingsResource;
use Vented\Resources\AccountSshKeysResource;
use Vented\Resources\ApiTokensResource;
use Vented\Resources\AppBindingsResource;
use Vented\Resources\AppDeployResource;
use Vented\Resources\AppDomainsResource;
use Vented\Resources\AppLogsResource;
use Vented\Resources\AppsResource;
use Vented\Resources\BackupSettingsResource;
use Vented\Resources\BackupsResource;
use Vented\Resources\BillingCancellationsResource;
use Vented\Resources\BillingChangesResource;
use Vented\Resources\BillingInvoiceConfirmationsResource;
use Vented\Resources\BillingInvoicesResource;
use Vented\Resources\BillingOperationConfirmationsResource;
use Vented\Resources\BillingOperationsResource;
use Vented\Resources\BillingPaymentMethodsResource;
use Vented\Resources\BillingQuotesResource;
use Vented\Resources\BillingResource;
use Vented\Resources\BillingSetupIntentsResource;
use Vented\Resources\BlockStorageBackupsResource;
use Vented\Resources\BlockStoragesResource;
use Vented\Resources\DeploysResource;
use Vented\Resources\DeployTriggersResource;
use Vented\Resources\DevelopersResource;
use Vented\Resources\DnsZoneBindingsResource;
use Vented\Resources\DnsZoneRecordsResource;
use Vented\Resources\DnsZonesResource;
use Vented\Resources\FlowRunsResource;
use Vented\Resources\FlowsResource;
use Vented\Resources\GettingStartedResource;
use Vented\Resources\IntegrationsResource;
use Vented\Resources\KbSearchResource;
use Vented\Resources\MemberInvitationsResource;
use Vented\Resources\MembersResource;
use Vented\Resources\NotificationsResource;
use Vented\Resources\ObjectStorageBackupsResource;
use Vented\Resources\ObjectStoragesResource;
use Vented\Resources\OrganizationInvitationsResource;
use Vented\Resources\OrganizationMembersResource;
use Vented\Resources\OrganizationSettingsResource;
use Vented\Resources\OrganizationsResource;
use Vented\Resources\OrganizationTransferResource;
use Vented\Resources\PlatformLocationsResource;
use Vented\Resources\ProjectPinsResource;
use Vented\Resources\ProjectsResource;
use Vented\Resources\RealtimeResource;
use Vented\Resources\SearchResource;
use Vented\Resources\ServiceBackupsResource;
use Vented\Resources\ServiceBindingOutputsResource;
use Vented\Resources\ServiceBindingsResource;
use Vented\Resources\ServicesResource;
use Vented\Resources\SettingsResource;
use Vented\Resources\SshKeysResource;
use Vented\Resources\StackCandidatesResource;
use Vented\Resources\StackOperationsResource;
use Vented\Resources\StacksResource;
use Vented\Resources\StorageFileContentsResource;
use Vented\Resources\StorageFilesResource;
use Vented\Resources\StorageFileTreesResource;
use Vented\Resources\StorageFileUploadPartsResource;
use Vented\Resources\StorageFileUploadsResource;
use Vented\Resources\SupportKbResource;
use Vented\Resources\SupportPlansResource;
use Vented\Resources\SupportResource;
use Vented\Resources\SupportTicketAccessResource;
use Vented\Resources\SupportTicketRepliesResource;
use Vented\Resources\SupportTicketsResource;
use Vented\Resources\TunnelsResource;
use Vented\Resources\TwoFactorResource;

trait ResourceAccessors
{
    public function account(): AccountResource
    {
        return new AccountResource($this);
    }

    public function accountBilling(): AccountBillingResource
    {
        return new AccountBillingResource($this);
    }

    public function accountInvoices(): AccountInvoicesResource
    {
        return new AccountInvoicesResource($this);
    }

    public function accountSettings(): AccountSettingsResource
    {
        return new AccountSettingsResource($this);
    }

    public function accountSshKeys(): AccountSshKeysResource
    {
        return new AccountSshKeysResource($this);
    }

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

    public function appLogs(): AppLogsResource
    {
        return new AppLogsResource($this);
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

    public function billing(): BillingResource
    {
        return new BillingResource($this);
    }

    public function billingCancellations(): BillingCancellationsResource
    {
        return new BillingCancellationsResource($this);
    }

    public function billingChanges(): BillingChangesResource
    {
        return new BillingChangesResource($this);
    }

    public function billingInvoiceConfirmations(): BillingInvoiceConfirmationsResource
    {
        return new BillingInvoiceConfirmationsResource($this);
    }

    public function billingInvoices(): BillingInvoicesResource
    {
        return new BillingInvoicesResource($this);
    }

    public function billingOperationConfirmations(): BillingOperationConfirmationsResource
    {
        return new BillingOperationConfirmationsResource($this);
    }

    public function billingOperations(): BillingOperationsResource
    {
        return new BillingOperationsResource($this);
    }

    public function billingPaymentMethods(): BillingPaymentMethodsResource
    {
        return new BillingPaymentMethodsResource($this);
    }

    public function billingQuotes(): BillingQuotesResource
    {
        return new BillingQuotesResource($this);
    }

    public function billingSetupIntents(): BillingSetupIntentsResource
    {
        return new BillingSetupIntentsResource($this);
    }

    public function blockStorageBackups(): BlockStorageBackupsResource
    {
        return new BlockStorageBackupsResource($this);
    }

    public function blockStorages(): BlockStoragesResource
    {
        return new BlockStoragesResource($this);
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

    public function flowRuns(): FlowRunsResource
    {
        return new FlowRunsResource($this);
    }

    public function flows(): FlowsResource
    {
        return new FlowsResource($this);
    }

    public function gettingStarted(): GettingStartedResource
    {
        return new GettingStartedResource($this);
    }

    public function integrations(): IntegrationsResource
    {
        return new IntegrationsResource($this);
    }

    public function kbSearch(): KbSearchResource
    {
        return new KbSearchResource($this);
    }

    public function memberInvitations(): MemberInvitationsResource
    {
        return new MemberInvitationsResource($this);
    }

    public function members(): MembersResource
    {
        return new MembersResource($this);
    }

    public function notifications(): NotificationsResource
    {
        return new NotificationsResource($this);
    }

    public function objectStorageBackups(): ObjectStorageBackupsResource
    {
        return new ObjectStorageBackupsResource($this);
    }

    public function objectStorages(): ObjectStoragesResource
    {
        return new ObjectStoragesResource($this);
    }

    public function organizationInvitations(): OrganizationInvitationsResource
    {
        return new OrganizationInvitationsResource($this);
    }

    public function organizationMembers(): OrganizationMembersResource
    {
        return new OrganizationMembersResource($this);
    }

    public function organizationSettings(): OrganizationSettingsResource
    {
        return new OrganizationSettingsResource($this);
    }

    public function organizationTransfer(): OrganizationTransferResource
    {
        return new OrganizationTransferResource($this);
    }

    public function organizations(): OrganizationsResource
    {
        return new OrganizationsResource($this);
    }

    public function platformLocations(): PlatformLocationsResource
    {
        return new PlatformLocationsResource($this);
    }

    public function projectPins(): ProjectPinsResource
    {
        return new ProjectPinsResource($this);
    }

    public function projects(): ProjectsResource
    {
        return new ProjectsResource($this);
    }

    public function realtime(): RealtimeResource
    {
        return new RealtimeResource($this);
    }

    public function search(): SearchResource
    {
        return new SearchResource($this);
    }

    public function serviceBackups(): ServiceBackupsResource
    {
        return new ServiceBackupsResource($this);
    }

    public function serviceBindingOutputs(): ServiceBindingOutputsResource
    {
        return new ServiceBindingOutputsResource($this);
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

    public function stackCandidates(): StackCandidatesResource
    {
        return new StackCandidatesResource($this);
    }

    public function stackOperations(): StackOperationsResource
    {
        return new StackOperationsResource($this);
    }

    public function stacks(): StacksResource
    {
        return new StacksResource($this);
    }

    public function storageFileContents(): StorageFileContentsResource
    {
        return new StorageFileContentsResource($this);
    }

    public function storageFileTrees(): StorageFileTreesResource
    {
        return new StorageFileTreesResource($this);
    }

    public function storageFileUploadParts(): StorageFileUploadPartsResource
    {
        return new StorageFileUploadPartsResource($this);
    }

    public function storageFileUploads(): StorageFileUploadsResource
    {
        return new StorageFileUploadsResource($this);
    }

    public function storageFiles(): StorageFilesResource
    {
        return new StorageFilesResource($this);
    }

    public function support(): SupportResource
    {
        return new SupportResource($this);
    }

    public function supportKb(): SupportKbResource
    {
        return new SupportKbResource($this);
    }

    public function supportPlans(): SupportPlansResource
    {
        return new SupportPlansResource($this);
    }

    public function supportTicketAccess(): SupportTicketAccessResource
    {
        return new SupportTicketAccessResource($this);
    }

    public function supportTicketReplies(): SupportTicketRepliesResource
    {
        return new SupportTicketRepliesResource($this);
    }

    public function supportTickets(): SupportTicketsResource
    {
        return new SupportTicketsResource($this);
    }

    public function tunnels(): TunnelsResource
    {
        return new TunnelsResource($this);
    }

    public function twoFactor(): TwoFactorResource
    {
        return new TwoFactorResource($this);
    }
}
