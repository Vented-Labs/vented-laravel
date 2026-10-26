<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppTerminalMeta
{
    public function __construct(
        public bool $can_execute,
        public ?TerminalExecutionContext $execution_context,
        public ?string $reason,
        public bool $supported,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_execute: (bool) $data['can_execute'],
            execution_context: $data['execution_context'] === null ? null : TerminalExecutionContext::fromArray(self::objectValue($data['execution_context'])),
            reason: $data['reason'] === null ? null : (string) $data['reason'],
            supported: (bool) $data['supported'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_execute'] = $this->can_execute;
        $data['execution_context'] = $this->execution_context === null ? null : $this->execution_context->toArray();
        $data['reason'] = $this->reason === null ? null : $this->reason;
        $data['supported'] = $this->supported;

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
