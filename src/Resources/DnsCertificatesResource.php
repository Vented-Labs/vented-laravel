<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\CertificateData;
use Vented\Data\StoreCertificateData;
use Vented\Data\UpdateCertificateData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class DnsCertificatesResource
{
    public function __construct(private Vented $client) {}

    /**
     * Upload a custom certificate
     *
     * Operation: projects.dns.certificates.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<CertificateData>
     */
    public function create(string $project, StoreCertificateData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/dns/certificates')
            ->withPathParameters(['project' => $project])
            ->withBody([
                'data' => [
                    'type' => 'certificates',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): CertificateData => CertificateData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Delete a custom certificate
     *
     * Operation: projects.dns.certificates.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $certificate, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/dns/certificates/{certificate}')
            ->withPathParameters(['project' => $project, 'certificate' => $certificate])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Show a custom certificate
     *
     * Operation: projects.dns.certificates.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<CertificateData>
     */
    public function find(string $project, string $certificate, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/dns/certificates/{certificate}')
            ->withPathParameters(['project' => $project, 'certificate' => $certificate])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): CertificateData => CertificateData::fromArray(self::attributes($resource, true)));
    }

    /**
     * List custom certificates
     *
     * Operation: projects.dns.certificates.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<CertificateData>
     */
    public function list(string $project, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/dns/certificates')
            ->withPathParameters(['project' => $project])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): CertificateData => CertificateData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Rename or replace a custom certificate
     *
     * Operation: projects.dns.certificates.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<CertificateData>
     */
    public function update(string $project, string $certificate, UpdateCertificateData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/dns/certificates/{certificate}')
            ->withPathParameters(['project' => $project, 'certificate' => $certificate])
            ->withBody([
                'data' => [
                    'type' => 'certificates',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): CertificateData => CertificateData::fromArray(self::attributes($resource, true)));
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
