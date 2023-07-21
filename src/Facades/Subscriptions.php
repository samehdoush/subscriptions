<?php

namespace Samehdoush\Subscriptions\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Samehdoush\Subscriptions\Subscriptions
 */
class Subscriptions extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Samehdoush\Subscriptions\Subscriptions::class;
    }
}
