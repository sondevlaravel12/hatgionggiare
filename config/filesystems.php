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
        'media' => [
            'driver' => 'local',

            // directory for storing
            'root'   => public_path('media/posts'),
            // 'root'   => public_path('storage'),

            // directory for geting image url
            'url'    => env('APP_URL').'/media/posts',
            // 'url'    => env('APP_URL').'/storage',
        ],
        // for spatie media custome path
        'postFiles' => [
            'driver' => 'local',
            'root'   => storage_path('app/public/posts'),
            'url'        => env('APP_URL') . '/posts',
            'visibility' => 'public'
        ],

        'productFiles' => [
            'driver' => 'local',
            'root'   => storage_path('app/public/products'),
            'url'        => env('APP_URL') . '/products',
            'visibility' => 'public'
        ],
        'sliderFiles' => [
            'driver' => 'local',
            'root'   => storage_path('app/public/sliders'),
            'url'        => env('APP_URL') . '/sliders',
            'visibility' => 'public'
        ],
        'categoryFiles' => [
            'driver' => 'local',
            'root'   => storage_path('app/public/categories'),
            'url'        => env('APP_URL') . '/categories',
            'visibility' => 'public'
        ],

        'general' => [
            'driver' => 'local',
            'root' => storage_path('app/public/generals'),
            'url' => env('APP_URL').'/generals',
            'visibility' => 'public',
            'throw' => false,
        ],
        // end for spatie media custome path

        // 'media' => [
        //     'driver' => 'local',
        //     'root'   => public_path('media'),
        //     'url'    => env('APP_URL').'/media',
        // ],

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
        // public_path('storage') => storage_path('app/public'),
        public_path('generals') => storage_path('app/public/generals'),
        public_path('posts') => storage_path('app/public/posts'),
        public_path('products') => storage_path('app/public/products'),
        public_path('sliders') => storage_path('app/public/sliders'),
    ],

];
