<?php

declare(strict_types=1);

namespace Vented\Results;

use Illuminate\Http\Client\Response;

final readonly class NoContentResult
{
    public function __construct(public Response $response) {}
}
