<?php

namespace Xcms\Nav\Facades;

use Illuminate\Support\Facades\Facade;
use Xcms\Nav\Support\NavSupport;

class NavFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return NavSupport::class;
    }
}
