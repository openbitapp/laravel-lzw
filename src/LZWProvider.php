<?php

namespace Openbitapp\LZW;

use Illuminate\Support\ServiceProvider;

class LZWProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->bind(LZW::class, function () {
            return new LZW();
        });

        $this->app->alias(LZW::class, 'laravel-lzw');
    }
}