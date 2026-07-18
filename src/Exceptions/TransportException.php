<?php

declare(strict_types=1);

namespace Vented\Exceptions;

use Throwable;

final class TransportException extends VentedException
{
    public function __construct(Throwable $previous)
    {
        parent::__construct('The Vented API could not be reached: '.$previous->getMessage(), 0, $previous);
    }
}
