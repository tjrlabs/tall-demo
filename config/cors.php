<?php

return [
    'paths' => ['*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => [
        'https://jais-newsletter-9325ee.beehiiv.com',
    ],
    'allowed_origins_patterns' => ['#^https://.*\.beehiiv\.com$#'],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 86400,
    'supports_credentials' => false,
];
