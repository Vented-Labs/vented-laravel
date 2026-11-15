<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SendingDomainsIndexMeta
{
    public function __construct(
        public ?EmailAllowanceData $allowance,
        public bool $can_update,
        public ServicesIndexMetaFormOptions $form_options,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            allowance: $data['allowance'] === null ? null : EmailAllowanceData::fromArray(self::objectValue($data['allowance'])),
            can_update: (bool) $data['can_update'],
            form_options: ServicesIndexMetaFormOptions::fromArray(self::objectValue($data['form_options'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['allowance'] = $this->allowance === null ? null : $this->allowance->toArray();
        $data['can_update'] = $this->can_update;
        $data['form_options'] = $this->form_options->toArray();

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
