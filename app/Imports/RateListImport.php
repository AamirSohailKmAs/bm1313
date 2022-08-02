<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\RateList;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RateListImport implements ToModel, WithHeadingRow
{
    public $category;
    public function __construct()
    {
        $this->category = Category::whereNotNull('parent_id')->pluck('parent_id', 'id');
    }
    public function model(array $row)
    {
        // dd($this->category[$row['series_id']]);
        return new RateList([
            'name' => $row['name'],
            'price' => $row['price'],
            'min_price' => $row['min_price'],
            'series_id' => $row['series_id'],
            'brand_id' => $this->category[$row['series_id']],
        ]);
    }
}
