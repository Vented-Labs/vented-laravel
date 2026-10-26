<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class TerminalExecutionContext
{
    public function __construct(
        public string $home,
        public string $shell,
        public string $user,
        public string $working_directory,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            home: (string) $data['home'],
            shell: (string) $data['shell'],
            user: (string) $data['user'],
            working_directory: (string) $data['working_directory'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['home'] = $this->home;
        $data['shell'] = $this->shell;
        $data['user'] = $this->user;
        $data['working_directory'] = $this->working_directory;

        return $data;
    }
}
