<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Credit extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount', 'user_id', 'remark',
    ];

    /**
     * Interact with Credit's Amount.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value / 100),
            set: fn ($value) => ($value * 100),
        );
    }
}
