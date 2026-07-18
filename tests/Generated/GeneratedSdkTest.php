<?php

declare(strict_types=1);
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Vented\Data\ProjectData;
use Vented\Data\StoreProjectData;
use Vented\Generated\CommandRegistry;
use Vented\Generated\OperationRegistry;
use Vented\Results\CollectionResult;
use Vented\Results\PaginatedResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

it('publishes one unique generated resource action and command per operation', function (): void {
    $operations = OperationRegistry::all();

    expect($operations)->toHaveCount(96)
        ->and(array_unique(array_column($operations, 'operationId')))->toHaveCount(96)
        ->and(array_unique(array_map(
            static fn (array $operation): string => $operation['resource'].'.'.$operation['action'],
            $operations,
        )))->toHaveCount(96)
        ->and(array_unique(array_column($operations, 'commandName')))->toHaveCount(96)
        ->and(CommandRegistry::all())->toHaveCount(96);
});

it('makes representative generated project calls with typed results and canonical documents', function (): void {
    Http::fake([
        '*/projects' => Http::sequence()
            ->push([
                'data' => [[
                    'id' => 'project-list-1',
                    'type' => 'projects',
                    'attributes' => [
                        'created_at' => '2026-01-01T00:00:00Z',
                        'desired_status' => null,
                        'is_new' => false,
                        'is_synced' => true,
                        'location_id' => 'location-1',
                        'name' => 'Listed project',
                        'status' => 'active',
                        'synced_at' => '2026-01-01T00:00:00Z',
                    ],
                ]],
            ])
            ->push([
                'data' => [
                    'id' => 'project-1',
                    'type' => 'projects',
                    'attributes' => [
                        'created_at' => '2026-01-01T00:00:00Z',
                        'desired_status' => null,
                        'is_new' => true,
                        'is_synced' => false,
                        'location_id' => 'location-1',
                        'name' => 'Example',
                        'status' => 'pending',
                        'synced_at' => null,
                    ],
                ],
            ], 201),
        '*/platform-locations' => Http::response(['data' => []]),
        '*/projects/project-1/deploys' => Http::response([
            'data' => [],
            'meta' => [
                'total' => 0,
                'per_page' => 15,
                'current_page' => 1,
                'last_page' => 1,
                'from' => null,
                'to' => null,
            ],
            'links' => ['first' => null, 'last' => null, 'prev' => null, 'next' => null],
        ]),
        '*/projects/*' => Http::response(null, 204),
    ]);

    $client = $this->app->make(Vented::class);
    $listed = $client->projects()->list();
    $created = $client->projects()->create(new StoreProjectData(
        name: 'Example',
        location_id: 'location-1',
    ));
    $deleted = $client->projects()->delete('project/a');
    $locations = $client->platformLocations()->list();
    $deploys = $client->deploys()->list('project-1');

    expect($listed)->toBeInstanceOf(CollectionResult::class)
        ->and($listed->data[0]->id)->toBe('project-list-1')
        ->and($created)->toBeInstanceOf(ResourceResult::class)
        ->and($created->data)->toBeInstanceOf(ProjectData::class)
        ->and($created->data->id)->toBe('project-1')
        ->and($locations)->toBeInstanceOf(CollectionResult::class)
        ->and($deploys)->toBeInstanceOf(PaginatedResult::class)
        ->and($deleted->response->status())->toBe(204);

    Http::assertSent(fn (Request $request): bool => $request->method() === 'POST'
        && $request->data() === [
            'data' => [
                'type' => 'projects',
                'attributes' => ['location_id' => 'location-1', 'name' => 'Example'],
            ],
        ]);

    Http::assertSent(fn (Request $request): bool => str_ends_with($request->url(), '/projects/project%2Fa'));
});

it('exposes only options applicable to each generated command', function (): void {
    $commands = Artisan::all();
    $list = $commands['vented:projects:list']->getDefinition();
    $create = $commands['vented:projects:create']->getDefinition();
    $delete = $commands['vented:projects:delete']->getDefinition();
    $binary = $commands['vented:dns-zones:export']->getDefinition();

    expect($list->hasOption('query'))->toBeTrue()
        ->and($list->hasOption('json'))->toBeTrue()
        ->and($list->hasOption('data'))->toBeFalse()
        ->and($list->hasOption('force'))->toBeFalse()
        ->and($list->hasOption('output'))->toBeFalse()
        ->and($create->hasOption('data'))->toBeTrue()
        ->and($create->hasOption('force'))->toBeFalse()
        ->and($delete->hasOption('force'))->toBeTrue()
        ->and($delete->hasOption('data'))->toBeFalse()
        ->and($binary->hasOption('output'))->toBeTrue()
        ->and($binary->hasOption('data'))->toBeFalse()
        ->and($binary->hasOption('force'))->toBeFalse();
});

it('writes generated binary command output to stdout when requested', function (): void {
    Http::fake(['*' => Http::response('zone-data')]);

    $this->artisan('vented:dns-zones:export', [
        'project' => 'project-1',
        'zone' => 'zone-1',
        '--query' => ['format=bind'],
        '--output' => '-',
    ])->expectsOutputToContain('zone-data')->assertSuccessful();
});

it('runs the generated destructive command without runtime reflection', function (): void {
    Http::fake(['*' => Http::response(null, 204)]);

    $this->artisan('vented:projects:delete', [
        'project' => 'project/a',
        '--force' => true,
        '--json' => true,
    ])->assertSuccessful();

    Http::assertSent(fn (Request $request): bool => $request->method() === 'DELETE'
        && str_ends_with($request->url(), '/projects/project%2Fa'));
});
