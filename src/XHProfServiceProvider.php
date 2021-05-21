<?php

namespace Wareon\LaravelXhprof;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Wareon\LaravelXhprof\Middleware\XHProfMiddleware;
use Wareon\LaravelXhprof\Services\XHProfService;

class XHProfServiceProvider extends ServiceProvider
{

    /**
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            return;
        }

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/config/config.php',
            'xhprof'
        );

		
        $this->app->singleton(XHProfMiddleware::class);
        $this->app->singleton(XHProfService::class);

        if (config('xhprof.global_middleware', false)) {
            $this->extraMiddleware(XHProfMiddleware::class);
        }

    }

    /**
     * @param string $className
     */
    public function extraMiddleware(string $className): void
    {
        /**
         * @var \Illuminate\Foundation\Http\Kernel $kernel
         */
        $kernel = $this->app[Kernel::class];
        $kernel->pushMiddleware($className);
    }

}
