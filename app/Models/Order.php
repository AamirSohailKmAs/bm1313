<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;

class Order extends Model
{
    use HasFactory, SoftDeletes, MassPrunable;

    public function activation()
    {
        return $this->belongsTo(Activation::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the prunable model query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function prunable()
    {
        return static::where('deleted_at', '<=', now()->subMonth());
    }

    /**
     * Interact with Order's Cash Amount.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function cash(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value / 100),
            set: fn ($value) => ($value * 100),
        );
    }

    /**
     * Interact with Order's Multi Bank.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function mb(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value / 100),
            set: fn ($value) => ($value * 100),
        );
    }

    /**
     * Interact with Order's Unit Cost.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function unitCost(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value / 100),
            set: fn ($value) => ($value * 100),
        );
    }

    /**
     * Interact with Order's Total Payment.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function payment(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value / 100),
            set: fn ($value) => ($value * 100),
        );
    }

    /**
     * Interact with Order's Total Cost.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function tCost(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value / 100),
            set: fn ($value) => ($value * 100),
        );
    }

    /**
     * Interact with Order's Total Profit.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function tProfit(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value / 100),
            set: fn ($value) => ($value * 100),
        );
    }
}
