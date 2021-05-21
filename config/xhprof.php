<?php
/**
 * Config
 */
return [
    'path'       => '/tmp/xhprof',
    'enabled'    => true,
    'freq'       => 1,
    'flags'      => XHPROF_FLAGS_MEMORY | XHPROF_FLAGS_CPU,
    'output_dir' => '/tmp/xhprof',
    'run_id'     => date('YmdHis') . uniqid(),

    'global_middleware' => true,
    'name' => 'xhprof',
    'extension_name' => 'xhprof',
    'provider' => \Wareon\LaravelXhprof\Providers\XHProfProvider::class,

    'database' => [
        'driver' => 'mongodb',
        'host' => env('XHPROF_DB_HOST', '127.0.0.1'),
        'port' => env('XHPROF_DB_PORT', 27017),
        'database' => env('XHPROF_DB_DATABASE', 'xhprof'),
        'username' => env('XHPROF_DB_USERNAME', ''),
        'password' => env('XHPROF_DB_PASSWORD', ''),
    ],

];
