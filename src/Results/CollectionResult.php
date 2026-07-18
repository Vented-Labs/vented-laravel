<?php

declare(strict_types=1);

namespace Vented\Results;

use Illuminate\Http\Client\Response;

/**
 * @template TResource
 */
final readonly class CollectionResult
{
    /**
     * @param  list<TResource>  $data
     * @param  array<string, mixed>  $meta
     * @param  array<string, mixed>  $links
     */
    public function __construct(
        public array $data,
        public Response $response,
        public array $meta = [],
        public array $links = [],
    ) {}
}
