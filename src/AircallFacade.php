<?php

namespace CLDT\Aircall;

use Illuminate\Support\Facades\Facade;

class AircallFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'aircall';
    }
}
