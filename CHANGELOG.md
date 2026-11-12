# Changelog

All notable changes to `vented/vented-laravel` will be documented in this file.

## 0.34.0 - 2026-11-12

- Removed `environments()`, `environmentTransfers()` and `environmentTransferPresets()`, their Data classes and the `vented:environments:*`, `vented:environment-transfers:*` and `vented:environment-transfer-presets:*` commands. Environments are hidden until they return; a project works on its `production` environment.

## 0.33.0 - 2026-11-11

- Flows save in stages. `FlowStepData` gains `stage`, `FlowData` gains `committed_stages`, and `FlowRunData` gains `stage` and `finished`: each `flowRuns()->create()` carries out the next stage, and `next_url` is set once the last one is done.

## 0.32.0 - 2026-11-11

- Added `flows()` to read a guided flow (`find`), save one of its steps (`update` with `UpdateFlowData`) and discard the saved answers (`delete`), and `flowRuns()->create()` to carry a flow out, with `FlowData`, `FlowStepData`, `FlowFieldData` and `FlowRunData` and the `vented:account:flows:*` commands.

## 0.31.0 - 2026-11-11

- Added `appBindings()->rotate()` and `serviceBindings()->rotate()` to rotate a service binding's credentials, with the `vented:app-bindings:rotate` and `vented:service-bindings:rotate` commands.
- Added `services()->outputs()` and `serviceBindingOutputs()->list()` to read a service resource's or binding's connection details, with `ServiceOutputsData`, `ServiceOutputData` and the `vented:services:outputs` and `vented:service-binding-outputs:list` commands.
- `BindingData` gains `variables`, `can_rotate` and `credentials_revision`. `ServiceData` gains `kind`, `kind_name` and `available`, `StoreServiceData` takes `kind`, and `ServiceCatalogEntry` lists each kind with `kind`, `service_name`, `area`, `available` and `reason`.

## 0.29.0 - 2026-11-10

- Added `tunnels()->agentSetup()` and the `vented:tunnels:agent-setup` command, with `TunnelAgentSetupData`: the connect hostname, port and path of an environment's tunnel server, the certificate to trust with the one name it is valid for, and the server's token. It answers 422 until the server runs.

## 0.28.0 - 2026-11-09

- Added `tunnels()` with `list()`, `find()`, `create()`, `stop()`, `start()` and `delete()` for an environment's Vented Tunnels, with `TunnelData`, `StoreTunnelData`, `TunnelsIndexMeta` (availability and allowance), `TunnelStoreMeta` (the agent credential, returned once) and the `vented:tunnels:*` commands.
- `ResourceUsageData` gains `tunnels`, the project's tunnels against its settled allowance.

## 0.27.0 - 2026-11-06

- `PlanCatalogExtraData` gains `key`, `billing_kind`, `resource` and `units`, so an extra can be matched to the billing product a quote buys and to how much one unit adds.
- `ProjectBillingData` gains `purchased_email_messages`, the unused messages left on paid email packs.

## 0.26.0 - 2026-11-05

- Added `projectPins()->create()` and `->delete()` to pin and unpin a project, with `ProjectPinData` and the `vented:project-pins:create` and `vented:project-pins:delete` commands.
- `DashboardProjectData` gains `last_opened_at`, `pin_position` and `pin_url`.

## 0.25.0 - 2026-11-05

- `ManagedStackShowMeta` gains `overview`, a `ManagedStackOverviewData` with the stack's parts (`apps`, `services`, `storages`), their status, usage and problems in `inventory`, and the `recent_deploys` of its apps.

## 0.24.0 - 2026-11-05

- Added `organizations()->transfer()` to offer an organization to another member, and `organizationTransfer()->accept()` and `->cancel()` for them to take it over or for either side to call it off, with `TransferOrganizationData`, `TransferableMember` and `PendingTransferData`.
- Added `organizations()->delete()` for an organization with no projects left. Members leave through `organizationMembers()->delete()` with their own id.
- `OrganizationShowMeta` gains `can_delete`, `can_transfer_ownership`, `can_leave`, `can_accept_transfer`, `can_cancel_transfer`, `pending_transfer` and `transferable_members`.

## 0.23.0 - 2026-11-05

- Added organizations: list and show them, rename them or change their settings, list, update and remove their members, and send or cancel invitations, with `OrganizationData`, `OrganizationMemberData`, `OrganizationInviteData` and their request DTOs.
- Added `organization_name` to `DashboardProjectData`.
- Added `organizations()->create()`, and `project_ids` on `UpdateOrganizationMemberData` and `StoreOrganizationInviteData` to give a member specific projects.

## 0.22.0 - 2026-11-04

- Projects belong to organizations: `ProjectData` gains `organization_id`, and `StoreProjectData` takes an optional `organization_id`, required when you manage more than one organization.
- Removed `projects()->update()`, the `vented:projects:update` command, `UpdateProjectData` and `TransferableMember`: projects no longer have their own owner to transfer.
- `ProjectMemberData` gains `from_organization`, true when the person's access comes from their organization role. `MembersIndexMeta::$is_owner` is now `$can_manage_admins`.
- Removed `can_transfer_ownership` and `transferable_members` from `SettingsShowMetaCapabilities`.

## 0.21.0 - 2026-11-04

- Added `verified` to `DnsZoneData`: whether Platform has seen the zone's TXT challenge or, for Vented DNS, its nameservers. Nothing is served for the zone until it has.

## 0.20.0 - 2026-11-04

- Added the files API for object and block storage: `storageFiles()->find()`, `->update()` (rename or move) and `->download()`, `storageFileTrees()->list()`, `storageFileUploads()` (`create()`, `find()`, `update()`, `delete()`) and `storageFileUploadParts()->update()` for uploads in parts, with their `vented:projects:storages:*` commands.
- Added `FileCapabilitiesData`, `FileTreesIndexMeta`, `FileUploadData`, `StoreFileUploadData`, `UpdateFileData`, `UpdateFileUploadData` and the `FileKind` enum.
- `StoreFileData` gains `source` and `overwrite` for copies; its `kind` is `file`, `directory`, `empty` (an empty file) or `copy`.
- Replaced `FilesIndexMetaCapabilities` with `FileCapabilitiesData` on `FilesIndexMeta::$capabilities`.

## 0.18.0 - 2026-11-02

- Added `network` to `ResourceTelemetry`: bytes per second received and sent, as `TelemetryNetwork` with `TelemetryNetworkPoint` history. App telemetry now reports measured usage with `source` `observed`.
- Replaced `PlanSampleUsageData` and `PlanSampleMetricData` with `ResourceUsageData` and `ResourceUsageMetricData`: measured usage against the plan's allowances, where `used` and `limit` may be null. `PlanData::$sample_usage` is now `$resource_usage`, and `OverviewShowMeta::$usage` uses the new type.
- Removed `requests` and `uptime` from `OverviewShowMeta`.
- Removed `telemetry` from `ServiceData` and `monitoring` from `ServiceShowMeta`: managed services report no usage.

## 0.17.0 - 2026-11-02

- Added `appLogs()->list()` and the `vented:app-logs:list` command for `projects.apps.logs`: an app's container and initializer output, newest first, as `AppLogLineData`, with `AppLogsIndexMeta` and `AppEventData` for the app's setup events.

## 0.16.0 - 2026-11-01

- Added `plan_name` to `ProjectBillingData`: the plan's display name from the billing catalog, next to `plan_key`.

## 0.15.0 - 2026-11-01

- Added `s3_providers` to `ObjectStorageIndexMetaFormOptions`: the bring-your-own S3 providers a bucket can be linked from, as `S3ProviderOption`.
- Added `s3_provider`, `account` and `path_style` to `StoreObjectStorageData`.

## 0.14.0 - 2026-10-30

- Added `status` to `DnsZoneData`: whether Vented serves the zone and its delegation is in place.
- Added `dns_target` to `AppBindingData` and `AppBindingMeta`: the CNAME target Vented publishes for the hostname.

## 0.13.0 - 2026-10-28

- Removed `facility` from `PlatformLocationData`; a location is now a region that groups one or more datacenters.

## 0.12.0 - 2026-10-26

- Added app desired status, generation, pending-operation fields, and lifecycle operation metadata.
- Start, stop, and restart now require `AppLifecycleData` for the lifecycle request body.
- Added the app terminal resource method, command, and terminal metadata DTOs.

## 0.11.0 - 2026-10-22

- Removed the `Edge` and `R2` cases from `ObjectStorageProvider`; buckets are either `Vented` or `BringYourOwn`.

## 0.10.0 - 2026-10-20

- Added an optional `mark_color` to `StoreProjectData`, typed by the new `ProjectMarkColor` enum.

## 0.9.0 - 2026-10-13

- Replaced the project `plan()` resource and its show, update, and usage commands with project billing resources and commands for quotes, changes, cancellations, payment methods, setup intents, operations, and invoices.
- Removed `PlanResource` and `SelectPlanData`; consumers must migrate plan purchases to the billing quote and change workflow.
- Added billing, credit, bandwidth, subscription, payment, and promotion DTOs, project billing configuration state, plan billing links, and service deletion permissions.

## 0.8.0 - 2026-10-12

- Added getting-started resource methods and commands for onboarding preferences.
- Added dashboard, onboarding, and stack relationship metadata to generated DTOs.

## 0.5.0 - 2026-10-07

- Added generic setup-field retrieval through `apps()->setup()` and `vented:apps:setup`, including Filebeam's sensitive setup token.
- Exposed configured credential paths and write-only form metadata in generated DTOs.

## 0.4.0 - 2026-10-07

- Statuses are a `StatusData` object with value, label, tone and transitional flag; the per-resource status enums are replaced by `StatusTone`.
- Added the allowed app actions, deploy statistics on the deploys listing, and the binding target on DNS zones.
- Added member roles, their two-factor status and the project's member management flag.

## 0.3.0 - 2026-10-05

- Regenerated resource and metadata DTOs for telemetry, locations, plan catalog and usage, and storage capabilities.
- Added DNS redirect status to record read/write DTOs.
- Preserved unavailable object-storage statistics as nullable values.

## 0.2.0 - 2026-08-18

- Added project environment, configuration transfer, and reusable transfer-preset resources.
- Scoped operational resource methods and commands by environment slug.
- Replaced project synchronization fields with the production environment reference.

## 0.1.0 - 2026-07-17

- Initial package runtime, transport, result objects, and Laravel integration.
