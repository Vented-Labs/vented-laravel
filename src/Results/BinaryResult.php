<?php

declare(strict_types=1);

namespace Vented\Results;

use Illuminate\Http\Client\Response;

final readonly class BinaryResult
{
    public function __construct(
        public string $body,
        public Response $response,
        public ?string $contentType = null,
    ) {}
}
