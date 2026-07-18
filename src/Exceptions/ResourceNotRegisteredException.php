<?php

declare(strict_types=1);

namespace Vented\Exceptions;

final class ResourceNotRegisteredException extends VentedException
{
    public function __construct(string $name)
    {
        parent::__construct("The Vented resource accessor [{$name}] is not registered.");
    }
}
