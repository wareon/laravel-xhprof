# laravel-xhprof

# require
composer require wareon/laravel-xhprof

# php-extension
php_xhprof-2.2.3

# php.ini
```ini
[xhprof]
extension=xhprof
xhprof.output_dir="/tmp/xhprof"
```

# config/xhprof.php

```php
<?php
/**
 * config xhprof
 * @ctime:     2021/5/20 21:58
 */
return [
    'path'       => env('XHPROF_PATH', '/tmp/xhprof'),
    'enabled'    => env('XHPROF_ENABLED', false),
    'freq'       => 1,
    'flags'      => XHPROF_FLAGS_MEMORY | XHPROF_FLAGS_CPU,
    'output_dir' => env('XHPROF_PATH', '/tmp/xhprof'),
    'run_id'     => date('YmdHis') . uniqid(),

    'global_middleware' => env('XHPROF_ENABLED', false),
    'name' => 'xhprof',
    'extension_name' => 'xhprof',
    'provider' => \Wareon\LaravelXhprof\Providers\XHProfMongoDBProvider::class,

    'database' => [
        'driver' => 'mongodb',
        'host' => env('XHPROF_DB_HOST', '127.0.0.1'),
        'port' => env('XHPROF_DB_PORT', 27017),
        'database' => env('XHPROF_DB_DATABASE', 'xhprof'),
        'username' => env('XHPROF_DB_USERNAME', ''),
        'password' => env('XHPROF_DB_PASSWORD', ''),
        'options' => [
            'database' => env('DB_AUTHENTICATION_DATABASE', 'admin'), // required with Mongo 3+
        ],
    ],
];

```


# .env
```dotenv
XHPROF_ENABLED=true
XHPROF_PATH=D:\php\tmp\xhprof\xhprof
XHPROF_DB_HOST=127.0.0.1
XHPROF_DB_PORT=27017
XHPROF_DB_DATABASE=xhprof
XHPROF_DB_USERNAME=
XHPROF_DB_PASSWORD=
```
