<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\EmailMessageData;
use Vented\Results\PaginatedResult;
use Vented\Vented;

final readonly class EmailDomainLogsResource
{
    public function __construct(private Vented $client) {}

    /**
     * List the emails sent through a sending domain
     *
     * Operation: projects.email.domains.logs
     *
     * @param  array<string, mixed>  $query
     * @return PaginatedResult<EmailMessageData>
     */
    public function list(string $project, string $environment, string $sendingDomain, array $query = []): PaginatedResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/email/domains/{sendingDomain}/logs')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'sendingDomain' => $sendingDomain])
            ->withQuery($query);

        return $operation->paginated(static fn (array $resource): EmailMessageData => EmailMessageData::fromArray(self::attributes($resource, true)));
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
