<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\OptionalValue;

final readonly class UpdateFileContentData
{
    public function __construct(
        public string $content,
        public string|OptionalValue $encoding = OptionalValue::Missing,
        public string|null|OptionalValue $if_match = OptionalValue::Missing,
        public string|null|OptionalValue $mime_type = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            content: (string) $data['content'],
            encoding: array_key_exists('encoding', $data) ? (string) $data['encoding'] : OptionalValue::Missing,
            if_match: array_key_exists('if_match', $data) ? $data['if_match'] === null ? null : (string) $data['if_match'] : OptionalValue::Missing,
            mime_type: array_key_exists('mime_type', $data) ? $data['mime_type'] === null ? null : (string) $data['mime_type'] : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['content'] = $this->content;
        if ($this->encoding !== OptionalValue::Missing) {
            $data['encoding'] = $this->encoding;
        }
        if ($this->if_match !== OptionalValue::Missing) {
            $data['if_match'] = $this->if_match === null ? null : $this->if_match;
        }
        if ($this->mime_type !== OptionalValue::Missing) {
            $data['mime_type'] = $this->mime_type === null ? null : $this->mime_type;
        }

        return $data;
    }
}
