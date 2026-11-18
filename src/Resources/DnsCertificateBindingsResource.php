<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\AppBindingData;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class DnsCertificateBindingsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Remove a custom certificate from a binding
     *
     * Operation: projects.dns.certificates.bindings.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $certificate, string $binding, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/dns/certificates/{certificate}/bindings/{binding}')
            ->withPathParameters(['project' => $project, 'certificate' => $certificate, 'binding' => $binding])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Install a custom certificate on a binding
     *
     * Operation: projects.dns.certificates.bindings.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<AppBindingData>
     */
    public function update(string $project, string $certificate, string $binding, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PUT', '/projects/{project}/dns/certificates/{certificate}/bindings/{binding}')
            ->withPathParameters(['project' => $project, 'certificate' => $certificate, 'binding' => $binding])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): AppBindingData => AppBindingData::fromArray(self::attributes($resource, true)));
    }

    /**
     * @param  array<string, mixed>  $resource
     * @return array<string, mixed>
     */
    private static function attributes(array $resource, bool $includeId): array
    {
        $attributes = $resource['attributes'] ?? null;

        if (! is_array($attributes) || array_is_list($attributes)) {
            throw new \UnexpectedValueException('The JSON:API resource attributes must be an object.');
        }

        if ($includeId) {
            $id = $resource['id'] ?? null;

            if (! is_string($id)) {
                throw new \UnexpectedValueException('The JSON:API resource id must be a string.');
            }

            $attributes['id'] = $id;
        }

        return $attributes;
    }
}
