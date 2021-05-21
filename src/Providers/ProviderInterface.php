<?php

namespace Wareon\LaravelXhprof\Providers;

interface ProviderInterface
{
    /**
     * @return void
     */
    public function enable();

    /**
     * @return void
     */
    public function disable();
}
