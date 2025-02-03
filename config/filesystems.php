<?php

return [

    'default' => env('FILESYSTEM_DISK', 'local'),

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

        'DashboardTask' => [
            'driver' => 'local',
            'root' => storage_path('app/public/Dashboard/Task'),
            'throw' => false,
        ],

        'ProcurementContract' => [
            'driver' => 'local',
            'root' => storage_path('app/public/Procurement/Contract'),
            'throw' => false,
        ],

        'CoverdeskTicket' => [
            'driver' => 'local',
            'root' => storage_path('app/public/Coverdesk/Ticket'),
            'throw' => false,
        ],

        'CoverdeskProject' => [
            'driver' => 'local',
            'root' => storage_path('app/public/Coverdesk/Project'),
            'throw' => false,
        ],

        'CoverdeskMaintenancePatchTest' => [
            'driver' => 'local',
            'root' => storage_path('app/public/Coverdesk/Maintenance/PatchTest'),
            'throw' => false,
        ],

        'CoverdeskMaintenance' => [
            'driver' => 'local',
            'root' => storage_path('app/public/Coverdesk/Maintenance'),
            'throw' => false,
        ],

        'AssetModel' => [
            'driver' => 'local',
            'root' => storage_path('app/public/Setting/AssetModel'),
            'throw' => false,
        ],

        'KnowledgebaseStep' => [
            'driver' => 'local',
            'root' => storage_path('app/public/Knowledgebase/Step'),
            'throw' => false,
        ],

        'APISFC' => [
            'driver' => 'local',
            'root' => storage_path('app/public/API/SFC'),
            'throw' => false,
        ],

        'attachments' => [
            'driver' => 'local',
            'root' => storage_path('app/attachments'),
        ],

    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
