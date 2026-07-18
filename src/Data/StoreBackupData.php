<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\BackupType;

final readonly class StoreBackupData
{
    public function __construct(
        public ?string $storage_id,
        public string $storage_type,
        public BackupType $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            storage_id: $data['storage_id'] === null ? null : (string) $data['storage_id'],
            storage_type: (string) $data['storage_type'],
            type: BackupType::from((string) $data['type']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['storage_id'] = $this->storage_id === null ? null : $this->storage_id;
        $data['storage_type'] = $this->storage_type;
        $data['type'] = $this->type->value;

        return $data;
    }
}
