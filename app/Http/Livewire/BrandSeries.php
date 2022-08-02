<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class BrandSeries extends Component
{
    public $brands;
    public $series;

    public $brand;

    protected $rules = [
        'brands' => 'required',
    ];
    public function mount()
    {
        $this->brands = Category::where('parent_id', null)->get();
        $this->series = collect();
    }
    public function render()
    {
        return view('livewire.brand-series');
    }
    public function updatedBrand($value)
    {
        $this->series = Category::where(['parent_id' => $value])->get();
    }
}
