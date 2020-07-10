<?php

namespace AirTableLaravel\Facades;

use Illuminate\Support\Facades\Facade;


class AirTableFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'airtable';
    }
}