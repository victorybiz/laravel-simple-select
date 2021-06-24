<?php

namespace Victorybiz\SimpleLivewireSelect;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Victorybiz\SimpleLivewireSelect\Skeleton\SkeletonClass
 */
class SimpleLivewireSelectFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'simple-livewire-select';
    }
}
