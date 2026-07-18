<?php

declare(strict_types=1);

namespace Vented;

use Vented\Exceptions\InvalidConfigurationException;

final readonly class ClientConfiguration
{
    public function __construct(
        public ?string $apiKey,
        public string $baseUrl,
        public int $timeout,
        public int $connectTimeout,
        public int $retryTimes,
        public int $retryDelayMilliseconds,
    ) {
        if ($this->baseUrl === '' || filter_var($this->baseUrl, FILTER_VALIDATE_URL) === false) {
            throw new InvalidConfigurationException('The Vented base URL must be a valid absolute URL.');
        }

        if ($this->timeout <= 0) {
            throw new InvalidConfigurationException('The Vented timeout must be greater than zero.');
        }

        if ($this->connectTimeout <= 0) {
            throw new InvalidConfigurationException('The Vented connect timeout must be greater than zero.');
        }

        if ($this->retryTimes < 0) {
            throw new InvalidConfigurationException('The Vented retry count cannot be negative.');
        }

        if ($this->retryDelayMilliseconds < 0) {
            throw new InvalidConfigurationException('The Vented retry delay cannot be negative.');
        }
    }

    /**
     * @param  array<string, mixed>  $config
     */
    public static function fromArray(array $config): self
    {
        $apiKey = $config['api_key'] ?? null;
        $baseUrl = $config['base_url'] ?? 'https://vented.com';

        return new self(
            apiKey: is_string($apiKey) && trim($apiKey) !== '' ? trim($apiKey) : null,
            baseUrl: is_string($baseUrl) ? rtrim($baseUrl, '/') : '',
            timeout: self::integer($config, 'timeout', 30),
            connectTimeout: self::integer($config, 'connect_timeout', 10),
            retryTimes: self::integer($config, 'retry_times', 2),
            retryDelayMilliseconds: self::integer($config, 'retry_delay_milliseconds', 250),
        );
    }

    public function withApiKey(string $apiKey): self
    {
        $apiKey = trim($apiKey);

        if ($apiKey === '') {
            throw new InvalidConfigurationException('The Vented API key cannot be empty.');
        }

        return new self(
            apiKey: $apiKey,
            baseUrl: $this->baseUrl,
            timeout: $this->timeout,
            connectTimeout: $this->connectTimeout,
            retryTimes: $this->retryTimes,
            retryDelayMilliseconds: $this->retryDelayMilliseconds,
        );
    }

    public function withBaseUrl(string $baseUrl): self
    {
        return new self(
            apiKey: $this->apiKey,
            baseUrl: rtrim($baseUrl, '/'),
            timeout: $this->timeout,
            connectTimeout: $this->connectTimeout,
            retryTimes: $this->retryTimes,
            retryDelayMilliseconds: $this->retryDelayMilliseconds,
        );
    }

    /**
     * @param  array<string, mixed>  $config
     */
    private static function integer(array $config, string $key, int $default): int
    {
        $value = $config[$key] ?? $default;

        if (! is_int($value) && ! (is_string($value) && preg_match('/^-?\d+$/', $value) === 1)) {
            throw new InvalidConfigurationException("The Vented {$key} option must be an integer.");
        }

        return (int) $value;
    }
}
