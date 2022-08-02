<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateList extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'min_price',
        'brand_id',
        'series_id'
    ];
    public function series()
    {
        return $this->belongsTo(Category::class, 'series_id')->with('parent');
    }
}
