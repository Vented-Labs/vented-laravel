# Changelog

All notable changes to `vented/vented-laravel` will be documented in this file.

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
