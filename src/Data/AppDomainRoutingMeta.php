<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\InstallableType;

final readonly class AppDomainRoutingMeta
{
    public function __construct(
        public ?InstallableRef $installable,
        public ?InstallableType $installable_type,
        public ?FormOption $router,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            installable: $data['installable'] === null ? null : InstallableRef::fromArray(self::objectValue($data['installable'])),
            installable_type: $data['installable_type'] === null ? null : InstallableType::from((string) $data['installable_type']),
            router: $data['router'] === null ? null : FormOption::fromArray(self::objectValue($data['router'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['installable'] = $this->installable === null ? null : $this->installable->toArray();
        $data['installable_type'] = $this->installable_type === null ? null : $this->installable_type->value;
        $data['router'] = $this->router === null ? null : $this->router->toArray();

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
