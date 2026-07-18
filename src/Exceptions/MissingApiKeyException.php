<?php

declare(strict_types=1);

namespace Vented\Exceptions;

final class MissingApiKeyException extends VentedException
{
    public function __construct()
    {
        parent::__construct('No Vented API key is configured. Set VENTED_API_KEY or vented.api_key before sending requests.');
    }
}
