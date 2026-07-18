<?php

declare(strict_types=1);

return [
    'api_key' => env('VENTED_API_KEY'),

    'base_url' => env('VENTED_BASE_URL', 'https://vented.com'),

    'commands_enabled' => (bool) env('VENTED_COMMANDS_ENABLED', true),

    'timeout' => (int) env('VENTED_TIMEOUT', 30),

    'connect_timeout' => (int) env('VENTED_CONNECT_TIMEOUT', 10),

    'retry_times' => (int) env('VENTED_RETRY_TIMES', 2),

    'retry_delay_milliseconds' => (int) env('VENTED_RETRY_DELAY_MILLISECONDS', 250),
];
