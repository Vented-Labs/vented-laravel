<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SettingsShowMetaCapabilities
{
    /**
     * @param  list<TransferableMember>  $transferable_members
     */
    public function __construct(
        public bool $can_delete,
        public bool $can_transfer_ownership,
        public array $transferable_members,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_delete: (bool) $data['can_delete'],
            can_transfer_ownership: (bool) $data['can_transfer_ownership'],
            transferable_members: array_map(static fn (mixed $value): TransferableMember => TransferableMember::fromArray(self::objectValue($value)), self::listValue($data['transferable_members'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_delete'] = $this->can_delete;
        $data['can_transfer_ownership'] = $this->can_transfer_ownership;
        $data['transferable_members'] = array_map(static fn (TransferableMember $value) => $value->toArray(), $this->transferable_members);

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    private static function objectValue(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \InvalidArgumentException('Expected an object value.');
        }

        /** @var array<string, mixed> $value */
        return $value;
    }

    /**
     * @return list<mixed>
     */
    private static function listValue(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \InvalidArgumentException('Expected an array value.');
        }

        return array_values($value);
    }
}
