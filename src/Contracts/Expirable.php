<?php

namespace Davideccia\TicTac\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

interface Expirable
{
    public function expirations(): MorphMany;
    public function lastExpiration(): MorphOne;
    public function okExpirations(): MorphMany;
    public function expiringExpirations(): MorphMany;
    public function expiredExpirations(): MorphMany;
}
