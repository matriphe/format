<?php

namespace Matriphe\Format;

use Illuminate\Support\Facades\Facade;

class FormatFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'format';
    }
}
