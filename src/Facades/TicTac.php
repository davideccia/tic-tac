<?php

namespace Davideccia\TicTac\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Davideccia\TicTac\TicTac
 */
class TicTac extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Davideccia\TicTac\TicTac::class;
    }
}
