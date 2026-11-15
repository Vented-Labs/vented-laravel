<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\ServiceData;
use Vented\Data\StoreServiceData;
use Vented\Results\NoContentResult;
use Vented\Results\PaginatedResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class EmailDomainsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Add a sending domain
     *
     * Operation: projects.email.domains.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ServiceData>
     */
    public function create(string $project, string $environment, StoreServiceData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/email/domains')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withBody([
                'data' => [
                    'type' => 'services',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ServiceData => ServiceData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Remove a sending domain
     *
     * Operation: projects.email.domains.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $environment, string $sendingDomain, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/{environment}/email/domains/{sendingDomain}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'sendingDomain' => $sendingDomain])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Show a sending domain
     *
     * Operation: projects.email.domains.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ServiceData>
     */
    public function find(string $project, string $environment, string $sendingDomain, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/email/domains/{sendingDomain}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'sendingDomain' => $sendingDomain])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ServiceData => ServiceData::fromArray(self::attributes($resource, true)));
    }

    /**
     * List sending domains for an environment
     *
     * Operation: projects.email.domains.index
     *
     * @param  array<string, mixed>  $query
     * @return PaginatedResult<ServiceData>
     */
    public function list(string $project, string $environment, array $query = []): PaginatedResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/email/domains')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withQuery($query);

        return $operation->paginated(static fn (array $resource): ServiceData => ServiceData::fromArray(self::attributes($resource, true)));
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
