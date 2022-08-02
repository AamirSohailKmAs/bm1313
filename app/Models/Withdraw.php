<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Withdraw extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'manager_id',
        'due',
        'withdraw',
        'left',
        'details',
    ];

    /**
     * Interact with Withdraw Due Amount.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function due(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value / 100),
            set: fn ($value) => ($value * 100),
        );
    }
    /**
     * Interact with Withdraw Amount.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function withdraw(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value / 100),
            set: fn ($value) => ($value * 100),
        );
    }
    /**
     * Interact with Left Amount After Withdraw.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function left(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value / 100),
            set: fn ($value) => ($value * 100),
        );
    }
}
