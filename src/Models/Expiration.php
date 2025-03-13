<?php

namespace Davideccia\TicTac\Models;

use Carbon\CarbonImmutable;
use Davideccia\TicTac\Contracts\Expirable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property Expirable $expirable
 * @property CarbonImmutable $alert_date
 * @property CarbonImmutable $due_date
 * @property ?CarbonImmutable $managed_at
 * @property string $notes
 */
class Expiration extends Model
{
    use HasUuids;

    protected $table = 'expirations';
    protected $fillable = [
        'expirable_id',
        'expirable_type',
        'alert_date',
        'due_date',
        'managed_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'alert_date' => 'immutable_datetime',
            'due_date' => 'immutable_datetime',
            'managed_at' => 'immutable_datetime',
        ];
    }

    public function expirable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeOk(Builder $builder): Builder
    {
        return $builder
            ->where(fn(Builder $builder) => $builder
                ->where("alert_date", '>', now()->toDateString())
                ->where("due_date", '>', now()->toDateString())
            );
    }

    public function scopeExpiring(Builder $builder): Builder
    {
        return $builder
            ->where(fn (Builder $builder ) => $builder
                ->where("alert_date", '<=', now()->toDateString())
                ->where("due_date", '>', now()->toDateString())
            );
    }

    public function scopeExpired(Builder $builder): Builder
    {
        return $builder->where('due_date', '<', now()->toDateString());
    }

    /**
     * Marks the expiration as managed.
     *
     * @return bool
     * @throws \Throwable
     */
    public function manage(): bool
    {
        return $this->fill([
            'managed_at' => now()->toDateString(),
        ])->saveOrFail();
    }

    /**
     * Adds notes to the expiration.
     *
     * @param string $notes
     * @return bool
     * @throws \Throwable
     */
    public function addNotes(string $notes): bool
    {
        return $this->fill([
            'notes' => $notes,
        ])->saveOrFail();
    }
}
