<?php

namespace Davideccia\TicTac\Traits;

use Davideccia\TicTac\Facades\TicTac;
use Davideccia\TicTac\Models\Expiration;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Collection;

/**
 * @property ?Expiration $activeExpiration
 * @property ?Collection<Expiration> $expirations
 * @property ?Collection<Expiration> $okExpirations
 * @property ?Collection<Expiration> $expiringExpirations
 * @property ?Collection<Expiration> $expiredExpirations
 */
trait InteractsWithExpirations
{
    public function expirations(): MorphMany
    {
        return $this->morphMany(Expiration::class, 'expirable')->orderBy('due_date');
    }

    public function activeExpiration(): MorphOne
    {
        return $this->expirations()->orderByDesc('due_date')->one();
    }

    public function okExpirations(): MorphMany
    {
        return $this->expirations()->ok()->orderByDesc('alert_date');
    }

    public function expiringExpirations(): MorphMany
    {
        return $this->expirations()->expiring()->orderBy('alert_date');
    }

    public function expiredExpirations(): MorphMany
    {
        return $this->expirations()->expired()->orderBy('due_date');
    }

    public function newExpiration(): TicTac
    {
        $this->activeExpiration->manage();

        return new TicTac()->for($this);
    }
}
