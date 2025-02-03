<?php

return [

    'default' => env('MAIL_MAILER', 'support'),

    'mailers' => [

        'ticket' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', 'smtp.office365.com'),

            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'ssl'),

            'username' => env('MAIL_USERNAME', 'marshall.wan@covertech.com.my'),
            'password' => env('MAIL_PASSWORD', 'ACCESS_TOKEN'),

            'from' => [
                'address' => env('MAIL_FROM_ADDRESS', 'marshall.wan@covertech.com.my'),
                'name' => env('MAIL_FROM_NAME', 'Support'),
            ],
            'timeout' => null,
        ],

        'autoresponder' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', 'smtp.office365.com'),

            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'ssl'),

            'username' => env('MAIL_USERNAME', 'marshall.wan@covertech.com.my'),
            'password' => env('MAIL_PASSWORD', 'ACCESS_TOKEN'),

            'from' => [
                'address' => env('MAIL_FROM_ADDRESS', 'marshall.wan@covertech.com.my'),
                'name' => env('MAIL_FROM_NAME', 'Autoresponse'),
            ],
            'timeout' => null,
        ],

        'maintenance' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', 'smtp.office365.com'),

            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'ssl'),

            'username' => env('MAIL_USERNAME', 'marshall.wan@covertech.com.my'),
            'password' => env('MAIL_PASSWORD', 'ACCESS_TOKEN'),

            'from' => [
                'address' => env('MAIL_FROM_ADDRESS', 'marshall.wan@covertech.com.my'),
                'name' => env('MAIL_FROM_NAME', 'Maintenance'),
            ],
            'timeout' => null,
            'driver' => env('MAIL_DRIVER', 'microsoftgraph'),
        ],

        'project' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', 'smtp.office365.com'),

            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'ssl'),

            'username' => env('MAIL_USERNAME', 'mis@covertech.com.my'),
            'password' => env('MAIL_PASSWORD', 'ACCESS_TOKEN'),

            'from' => [
                'address' => env('MAIL_FROM_ADDRESS', 'mis@covertech.com.my'),
                'name' => env('MAIL_FROM_NAME', 'Project'),
            ],
            'timeout' => null,
            'driver' => env('MAIL_DRIVER', 'microsoftgraph'),
        ],

        'ses' => [
            'transport' => 'ses',
        ],

        'mailgun' => [
            'transport' => 'mailgun',
        ],

        'postmark' => [
            'transport' => 'postmark',
        ],

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'),
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],

        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
        ],
    ],

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

];
