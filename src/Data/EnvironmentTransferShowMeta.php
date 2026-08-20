<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class EnvironmentTransferShowMeta
{
    /**
     * @param  list<FormOption>  $actions
     * @param  list<FormOption>  $secret_policies
     */
    public function __construct(
        public array $actions,
        public bool $can_copy_secrets,
        public array $secret_policies,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            actions: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['actions'])),
            can_copy_secrets: (bool) $data['can_copy_secrets'],
            secret_policies: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['secret_policies'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['actions'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->actions);
        $data['can_copy_secrets'] = $this->can_copy_secrets;
        $data['secret_policies'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->secret_policies);

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
