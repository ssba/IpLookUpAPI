<?php

namespace App\Helper;

use Illuminate\Support\Facades\Facade;

class DNSBLLookUpFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'DNSBLLookUp';
    }
}
