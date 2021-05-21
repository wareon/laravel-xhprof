<?php

namespace Wareon\LaravelXhprof\Services;

use Wareon\LaravelXhprof\Providers\ProviderInterface;
use Wareon\LaravelXhprof\Providers\XHProfProvider;
use function extension_loaded;
use function mt_getrandmax;
use function mt_rand;

class XHProfService
{

    /**
     * @var ProviderInterface
     */
    protected $provider;

    /**
     * XHProfService constructor.
     */
    public function __construct()
    {
        if (!extension_loaded(config('xhprof.extension_name', 'xhprof'))) {
            return;
        }

        if (!config('xhprof.enabled', false)) {
            return;
        }

        $freq = config('xhprof.freq', 0.01);
        if ($freq >= (mt_rand() / mt_getrandmax())) {
            $cls = config('xhprof.provider', XHProfProvider::class);
            $this->provider = new $cls();
        }
    }

    public function enable()
    {
        if ($this->provider) {
            $this->provider->enable();
        }
    }

    public function disable()
    {
        if ($this->provider) {
            $this->provider->disable();
        }
    }

}
