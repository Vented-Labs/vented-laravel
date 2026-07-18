<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ServiceBackupsMeta
{
    public function __construct(
        public ServiceBackupsMetaService $service,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            service: ServiceBackupsMetaService::fromArray(self::objectValue($data['service'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['service'] = $this->service->toArray();

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
}
