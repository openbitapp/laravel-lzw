<?php

namespace Openbitapp\LZW;

use Illuminate\Support\Facades\Facade;

class LZWFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-lzw';
    }
}
