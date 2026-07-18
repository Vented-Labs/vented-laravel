<?php

declare(strict_types=1);

namespace Vented\Console;

use Illuminate\Console\Command;
use JsonException;
use Throwable;
use Vented\Exceptions\ApiException;
use Vented\Generated\GeneratedCommandDispatcher;
use Vented\Generated\OperationRegistry;
use Vented\Results\BinaryResult;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\PaginatedResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

abstract class GeneratedCommand extends Command
{
    abstract protected function operationId(): string;

    public function handle(Vented $client): int
    {
        $operation = OperationRegistry::get($this->operationId());

        if ($operation['destructive'] && ! (bool) $this->optionalOption('force')) {
            if (! $this->confirm("Run destructive operation [{$operation['operationId']}]?")) {
                $this->warn('Operation cancelled.');

                return self::FAILURE;
            }
        }

        try {
            $result = GeneratedCommandDispatcher::dispatch(
                $operation['operationId'],
                $client,
                $this->pathParameters($operation['pathParameters']),
                $operation['hasBody'] ? $this->data() : [],
                $this->query(),
            );

            return $this->renderResult($result, $operation['binary']);
        } catch (ApiException $exception) {
            $this->error("Vented API request failed with HTTP {$exception->response->status()}.");

            foreach ($exception->errors as $error) {
                $message = $error->detail ?? $error->title ?? 'Unknown API error';
                $this->line('  '.$message);
            }

            return self::FAILURE;
        } catch (Throwable $exception) {
            $this->error($exception->getMessage());

            return self::FAILURE;
        }
    }

    /**
     * @param  list<string>  $names
     * @return array<string, string>
     */
    private function pathParameters(array $names): array
    {
        $parameters = [];

        foreach ($names as $name) {
            $value = $this->argument($name);

            if (! is_scalar($value)) {
                throw new \InvalidArgumentException("Path argument [{$name}] must be a scalar value.");
            }

            $parameters[$name] = (string) $value;
        }

        return $parameters;
    }

    /**
     * @return array<string, mixed>
     */
    private function data(): array
    {
        $value = $this->optionalOption('data');

        if (! is_string($value) || trim($value) === '') {
            throw new \InvalidArgumentException('This operation requires --data with inline JSON or @path/to/file.json.');
        }

        if (str_starts_with($value, '@')) {
            $path = substr($value, 1);
            $contents = $path === '' ? false : @file_get_contents($path);

            if ($contents === false) {
                throw new \InvalidArgumentException("Unable to read data file [{$path}].");
            }

            $value = $contents;
        }

        try {
            $data = json_decode($value, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new \InvalidArgumentException('The --data value is not valid JSON: '.$exception->getMessage(), previous: $exception);
        }

        if (! is_array($data) || array_is_list($data)) {
            throw new \InvalidArgumentException('The --data value must decode to a JSON object of resource attributes.');
        }

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    private function query(): array
    {
        $values = $this->option('query');

        if (! is_array($values)) {
            return [];
        }

        $parts = [];

        foreach ($values as $value) {
            if (! is_string($value) || ! str_contains($value, '=')) {
                throw new \InvalidArgumentException('Every --query value must use key=value form.');
            }

            $parts[] = $value;
        }

        parse_str(implode('&', $parts), $query);
        $normalized = [];

        foreach ($query as $key => $value) {
            $normalized[(string) $key] = $value;
        }

        return $normalized;
    }

    /**
     * @param  ResourceResult<mixed>|CollectionResult<mixed>|PaginatedResult<mixed>|NoContentResult|BinaryResult  $result
     */
    private function renderResult(
        ResourceResult|CollectionResult|PaginatedResult|NoContentResult|BinaryResult $result,
        bool $binary,
    ): int {
        if ($binary) {
            if (! $result instanceof BinaryResult) {
                throw new \UnexpectedValueException('The generated binary operation returned an invalid result.');
            }

            $output = $this->optionalOption('output');

            if (! is_string($output) || trim($output) === '') {
                throw new \InvalidArgumentException('Binary operations require --output=path.');
            }

            if ($output === '-') {
                $this->output->write($result->body);

                return self::SUCCESS;
            }

            if (@file_put_contents($output, $result->body) === false) {
                throw new \RuntimeException("Unable to write binary output [{$output}].");
            }

            $this->info("Wrote binary response to {$output}.");

            return self::SUCCESS;
        }

        if ($result instanceof NoContentResult) {
            $this->line((bool) $this->option('json')
                ? json_encode(['status' => $result->response->status()], JSON_THROW_ON_ERROR)
                : "Request completed with HTTP {$result->response->status()}.");

            return self::SUCCESS;
        }

        $body = $result->response->body();

        if ((bool) $this->option('json')) {
            $this->line($body);
        } else {
            $decoded = json_decode($body, true);
            $this->line(is_array($decoded)
                ? (string) json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                : $body);
        }

        return self::SUCCESS;
    }

    private function optionalOption(string $name): mixed
    {
        if (! $this->getDefinition()->hasOption($name)) {
            return null;
        }

        return $this->option($name);
    }
}
