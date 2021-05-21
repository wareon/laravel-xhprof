<?php

namespace Wareon\LaravelXhprof\Middleware;

use Wareon\LaravelXhprof\Services\XHProfService;
use Closure;

class XHProfMiddleware
{

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        app(XHProfService::class)->enable();
        return $next($request);
    }

    /**
     * @param $request
     * @param $response
     */
    public function terminate($request, $response)
    {
        app(XHProfService::class)->disable();
    }

}
