<?php

namespace Rojtjo\LumenGlide;

use Illuminate\Support\Facades\Facade;

class UrlBuilder extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'glide.url_builder';
    }
}
