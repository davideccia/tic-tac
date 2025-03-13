<?php

namespace Davideccia\TicTac;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Davideccia\TicTac\Contracts\Expirable;
use Davideccia\TicTac\Exceptions\TicTacExpirationMisconfigurationException;

/**
 * @method static TicTac alertDate(Carbon|CarbonImmutable $alertDate)
 * @method static TicTac dueDate(Carbon|CarbonImmutable $dueDate)
 * @method static TicTac for(Expirable $model)
 */
class TicTac {

    private ?CarbonImmutable $alertDate = null;
    private ?CarbonImmutable $dueDate = null;
    private ?Expirable $expirable = null;

    public function __construct()
    {
    }

    public static function __callStatic(string $name, array $arguments)
    {
        return new static()->{$name}(...$arguments);
    }

    public function alertDate(Carbon|CarbonImmutable $alertDate): static
    {
        $this->alertDate = $alertDate;

        return $this;
    }

    public function dueDate(Carbon|CarbonImmutable $dueDate): static
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function for(Expirable $model): static
    {
        $this->expirable = $model;

        return $this;
    }

    public function save(): bool
    {
        throw_if(!filled($this->dueDate), new TicTacExpirationMisconfigurationException('Cannot save expiration, "dueDate" missing'));
        throw_if(!filled($this->expirable), new TicTacExpirationMisconfigurationException('Cannot save expiration, "expirable" missing'));

        return $this->expirable
            ->expirations()
            ->create([
                'alert_date' => $this->alertDate?->toDateString() ?? $this->dueDate->subDays(config('tic-tac.default_alert_before_due_days'))->toDateString(),
                'due_date' => $this->dueDate->toDateString(),
            ]);
    }
}
