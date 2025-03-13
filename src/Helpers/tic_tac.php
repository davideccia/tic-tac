<?php

use Davideccia\TicTac\TicTac;

if (!function_exists('tic_tac')) {
    function tic_tac(): TicTac
    {
        return new TicTac();
    }
}
