# Changelog

All notable changes to `vented/vented-laravel` will be documented in this file.

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
