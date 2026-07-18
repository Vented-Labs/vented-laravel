<?php

declare(strict_types=1);

namespace Vented\Exceptions;

use Illuminate\Http\Client\Response;
use Vented\JsonApi\JsonApiError;

final class ApiException extends VentedException
{
    /**
     * @param  list<JsonApiError>  $errors
     */
    public function __construct(
        public readonly Response $response,
        public readonly array $errors,
    ) {
        $description = $errors === [] ? null : ($errors[0]->detail ?? $errors[0]->title);
        $message = "The Vented API request failed with status {$response->status()}";

        parent::__construct($description === null ? "{$message}." : "{$message}: {$description}");
    }

    public static function fromResponse(Response $response): self
    {
        $document = $response->json();
        $rawErrors = is_array($document) ? ($document['errors'] ?? null) : null;
        $errors = [];

        if (is_array($rawErrors)) {
            foreach ($rawErrors as $rawError) {
                if (is_array($rawError)) {
                    $errors[] = JsonApiError::fromArray($rawError);
                }
            }
        }

        if ($errors === []) {
            $errors[] = new JsonApiError(
                status: (string) $response->status(),
                title: 'Vented API request failed',
            );
        }

        return new self($response, $errors);
    }
}
