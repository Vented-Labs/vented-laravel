<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SignInMethodsMeta
{
    /**
     * @param  list<SignInMethodsMetaProvider>  $providers
     */
    public function __construct(
        public string $confirm_with,
        public bool $has_password,
        public array $providers,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            confirm_with: (string) $data['confirm_with'],
            has_password: (bool) $data['has_password'],
            providers: array_map(static fn (mixed $value): SignInMethodsMetaProvider => SignInMethodsMetaProvider::fromArray(self::objectValue($value)), self::listValue($data['providers'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['confirm_with'] = $this->confirm_with;
        $data['has_password'] = $this->has_password;
        $data['providers'] = array_map(static fn (SignInMethodsMetaProvider $value) => $value->toArray(), $this->providers);

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
