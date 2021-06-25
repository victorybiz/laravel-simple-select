<?php

namespace Victorybiz\SimpleSelect;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Victorybiz\SimpleSelect\Skeleton\SkeletonClass
 */
class SimpleSelectFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'simple-select';
    }
}
