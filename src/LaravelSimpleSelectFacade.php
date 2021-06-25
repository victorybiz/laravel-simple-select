<?php

namespace Victorybiz\LaravelSimpleSelect;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Victorybiz\LaravelSimpleSelect\Skeleton\SkeletonClass
 */
class LaravelSimpleSelectFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-simple-select';
    }
}
