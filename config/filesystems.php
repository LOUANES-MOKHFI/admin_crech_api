<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

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
        'about' => [
            'driver' => 'local',
            'root'   => public_path().'/files/about',
            'url'    => env('APP_URL').'/public',
            'visibility' => 'public',
        ],
        'logo' => [
            'driver' => 'local',
            'root'   => public_path().'/files/logo',
            'url'    => env('APP_URL').'/public',
            'visibility' => 'public',
        ],
        'image_rc' => [
            'driver' => 'local',
            'root'   => public_path().'/files/image_rc',
            'url'    => env('APP_URL').'/public',
            'visibility' => 'public',
        ],
        'realisations' => [
            'driver' => 'local',
            'root'   => public_path().'/files/realisations',
            'url'    => env('APP_URL').'/public',
            'visibility' => 'public',
        ],
        'guide_pedagogique' => [
            'driver' => 'local',
            'root'   => public_path().'/files/guide_pedagogique',
            'url'    => env('APP_URL').'/public',
            'visibility' => 'public',
        ],
        'books_creche' => [
            'driver' => 'local',
            'root'   => public_path().'/files/books_creche',
            'url'    => env('APP_URL').'/public',
            'visibility' => 'public',
        ],
        'products' => [
            'driver' => 'local',
            'root'   => public_path().'/files/products',
            'url'    => env('APP_URL').'/public',
            'visibility' => 'public',
        ],
        'blogs' => [
            'driver' => 'local',
            'root'   => public_path().'/files/blogs',
            'url'    => env('APP_URL').'/public',
            'visibility' => 'public',
        ],

        'dossiers' => [
            'driver' => 'local',
            'root'   => public_path().'/files/dossiers',
            'url'    => env('APP_URL').'/public',
            'visibility' => 'public',
        ],
        'video' => [
            'driver' => 'local',
            'root'   => public_path().'/files/video',
            'url'    => env('APP_URL').'/public',
            'visibility' => 'public',
        ],
        'avis' => [
            'driver' => 'local',
            'root'   => public_path().'/files/avis',
            'url'    => env('APP_URL').'/public',
            'visibility' => 'public',
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

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
