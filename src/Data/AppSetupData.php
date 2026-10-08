<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppSetupData
{
    /**
     * @param  list<AppSetupField>  $fields
     */
    public function __construct(
        public array $fields,
        public string $id,
        public string $path,
        public int $port,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            fields: array_map(static fn (mixed $value): AppSetupField => AppSetupField::fromArray(self::objectValue($value)), self::listValue($data['fields'])),
            id: (string) $data['id'],
            path: (string) $data['path'],
            port: (int) $data['port'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['fields'] = array_map(static fn (AppSetupField $value) => $value->toArray(), $this->fields);
        $data['id'] = $this->id;
        $data['path'] = $this->path;
        $data['port'] = $this->port;

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
