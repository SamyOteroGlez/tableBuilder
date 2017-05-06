<?php

namespace Hasutesa\Dummy\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Description of TableBuilderFacade
 *
 * @author tesa
 */
class TableBuilderFacade extends Facade
{
    public static function getFacadeAccessor() 
    {
        return 'tableBuilder';
    }
}
