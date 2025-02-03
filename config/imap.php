<?php
/*
* File:     imap.php
* Category: config
* Author:   M. Goldenbaum
* Created:  24.09.16 22:36
* Updated:  -
*
* Description:
*  -
*/

return [

    'default' => env('IMAP_DEFAULT_ACCOUNT', 'default'),

    'date_format' => 'd-M-Y',

    'accounts' => [

        'Ticket' => [
            'host' => env('IMAP_HOST', 'outlook.office365.com'),
            'port' => env('IMAP_PORT', 993),
            'protocol' => env('IMAP_PROTOCOL', 'imap'),
            'encryption' => env('IMAP_ENCRYPTION', 'ssl'),
            'validate_cert' => env('IMAP_VALIDATE_CERT', true),

            'username' => env('IMAP_USERNAME', 'marshall.wan@covertech.com.my'),
            'password' => env('IMAP_PASSWORD', 'ACCESS_TOKEN'),

            'authentication' => env('IMAP_AUTHENTICATION', 'oauth'),
            'proxy' => [
                'socket' => null,
                'request_fulluri' => false,
                'username' => null,
                'password' => null,
            ],
        ],

        'Alert' => [
            'host' => env('IMAP_HOST', 'outlook.office365.com'),
            'port' => env('IMAP_PORT', 993),
            'protocol' => env('IMAP_PROTOCOL', 'imap'),
            'encryption' => env('IMAP_ENCRYPTION', 'ssl'),
            'validate_cert' => env('IMAP_VALIDATE_CERT', true),

            'username' => env('IMAP_USERNAME', 'marshall.wan@covertech.com.my'),
            'password' => env('IMAP_PASSWORD', 'ACCESS_TOKEN'),

            'authentication' => env('IMAP_AUTHENTICATION', 'oauth'),
            'proxy' => [
                'socket' => null,
                'request_fulluri' => false,
                'username' => null,
                'password' => null,
            ],
        ],

        'Maintenance' => [
            'host' => env('IMAP_HOST', 'outlook.office365.com'),
            'port' => env('IMAP_PORT', 993),
            'protocol' => env('IMAP_PROTOCOL', 'imap'),
            'encryption' => env('IMAP_ENCRYPTION', 'ssl'),
            'validate_cert' => env('IMAP_VALIDATE_CERT', true),

            'username' => env('IMAP_USERNAME', 'marshall.wan@covertech.com.my'),
            'password' => env('IMAP_PASSWORD', 'ACCESS_TOKEN'),

            'authentication' => env('IMAP_AUTHENTICATION', 'oauth'),
            'proxy' => [
                'socket' => null,
                'request_fulluri' => false,
                'username' => null,
                'password' => null,
            ],
        ],

        'Backup' => [
            'host' => env('IMAP_HOST', 'outlook.office365.com'),
            'port' => env('IMAP_PORT', 993),
            'protocol' => env('IMAP_PROTOCOL', 'imap'),
            'encryption' => env('IMAP_ENCRYPTION', 'ssl'),
            'validate_cert' => env('IMAP_VALIDATE_CERT', true),

            'username' => env('IMAP_USERNAME', 'mis@covertech.com.my'),
            'password' => env('IMAP_PASSWORD', 'ACCESS_TOKEN'),

            'authentication' => env('IMAP_AUTHENTICATION', 'oauth'),
            'proxy' => [
                'socket' => null,
                'request_fulluri' => false,
                'username' => null,
                'password' => null,
            ],
        ],

        'Project' => [
            'host' => env('IMAP_HOST', 'outlook.office365.com'),
            'port' => env('IMAP_PORT', 993),
            'protocol' => env('IMAP_PROTOCOL', 'imap'),
            'encryption' => env('IMAP_ENCRYPTION', 'ssl'),
            'validate_cert' => env('IMAP_VALIDATE_CERT', true),

            'username' => env('IMAP_USERNAME', 'mis@covertech.com.my'),
            'password' => env('IMAP_PASSWORD', 'ACCESS_TOKEN'),

            'authentication' => env('IMAP_AUTHENTICATION', 'oauth'),
            'proxy' => [
                'socket' => null,
                'request_fulluri' => false,
                'username' => null,
                'password' => null,
            ],
        ],
    ],

    'options' => [
        'delimiter' => '/',
        'fetch' => \Webklex\PHPIMAP\IMAP::FT_PEEK,
        'sequence' => \Webklex\PHPIMAP\IMAP::ST_UID,
        'fetch_body' => true,
        'fetch_flags' => true,
        'soft_fail' => false,
        'rfc822' => true,
        'debug' => false,
        'uid_cache' => true,
        'boundary' => '/boundary=(.*?(?=;)|(.*))/i',
        'message_key' => 'list',
        'fetch_order' => 'asc',
        'dispositions' => ['attachment', 'inline'],
        'common_folders' => [
            'root' => 'INBOX',
            'junk' => 'INBOX/Junk',
            'draft' => 'INBOX/Drafts',
            'sent' => 'INBOX/Sent',
            'trash' => 'INBOX/Trash',
        ],
        'decoder' => [
            'message' => 'utf-8',
            'attachment' => 'utf-8',
        ],
        'open' => [

        ],
    ],

    'flags' => ['recent', 'flagged', 'answered', 'deleted', 'seen', 'draft'],

    'events' => [
        'message' => [
            'new' => \Webklex\IMAP\Events\MessageNewEvent::class,
            'moved' => \Webklex\IMAP\Events\MessageMovedEvent::class,
            'copied' => \Webklex\IMAP\Events\MessageCopiedEvent::class,
            'deleted' => \Webklex\IMAP\Events\MessageDeletedEvent::class,
            'restored' => \Webklex\IMAP\Events\MessageRestoredEvent::class,
        ],
        'folder' => [
            'new' => \Webklex\IMAP\Events\FolderNewEvent::class,
            'moved' => \Webklex\IMAP\Events\FolderMovedEvent::class,
            'deleted' => \Webklex\IMAP\Events\FolderDeletedEvent::class,
        ],
        'flag' => [
            'new' => \Webklex\IMAP\Events\FlagNewEvent::class,
            'deleted' => \Webklex\IMAP\Events\FlagDeletedEvent::class,
        ],
    ],

    'masks' => [
        'message' => \Webklex\PHPIMAP\Support\Masks\MessageMask::class,
        'attachment' => \Webklex\PHPIMAP\Support\Masks\AttachmentMask::class,
    ],
];
