<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes, MassPrunable;
    protected $fillable = [
        'user_id',
        'qty',
        'movement_id',
        'unit_price',
        'remarks',
        'total'
    ];
    /**
     * Get the prunable model query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function prunable()
    {
        return static::where('deleted_at', '<=', now()->subMonth());
    }

    public function movement()
    {
        return $this->belongsTo(Movement::class);
    }

    /**
     * Interact with Expense Unit Price.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function unitPrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value / 100),
            set: fn ($value) => ($value * 100),
        );
    }

    /**
     * Interact with Expense Total Price.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value / 100),
            set: fn ($value) => ($value * 100),
        );
    }
}
