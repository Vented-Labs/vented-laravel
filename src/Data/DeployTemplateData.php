<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\DeployTemplateKind;

final readonly class DeployTemplateData
{
    /**
     * @param  list<string>  $produces
     * @param  list<string>  $tags
     */
    public function __construct(
        public ?string $description,
        public ?string $icon,
        public string $id,
        public DeployTemplateKind $kind,
        public string $name,
        public array $produces,
        public ?string $summary,
        public array $tags,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            description: $data['description'] === null ? null : (string) $data['description'],
            icon: $data['icon'] === null ? null : (string) $data['icon'],
            id: (string) $data['id'],
            kind: DeployTemplateKind::from((string) $data['kind']),
            name: (string) $data['name'],
            produces: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['produces'])),
            summary: $data['summary'] === null ? null : (string) $data['summary'],
            tags: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['tags'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['description'] = $this->description === null ? null : $this->description;
        $data['icon'] = $this->icon === null ? null : $this->icon;
        $data['id'] = $this->id;
        $data['kind'] = $this->kind->value;
        $data['name'] = $this->name;
        $data['produces'] = $this->produces;
        $data['summary'] = $this->summary === null ? null : $this->summary;
        $data['tags'] = $this->tags;

        return $data;
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
