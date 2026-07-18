<?php

declare(strict_types=1);

namespace Vented\Exceptions;

use Illuminate\Http\Client\Response;

final class InvalidResponseException extends VentedException
{
    public function __construct(
        string $message,
        public readonly Response $response,
    ) {
        parent::__construct($message);
    }
}
