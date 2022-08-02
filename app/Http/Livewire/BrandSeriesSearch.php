<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\RateList;

class BrandSeriesSearch extends Component
{
    public $brands;
    public $series;

    public $brand;
    public $serie;

    public $categories;

    public $editedRatelistIndex;

    public $search = '';
    protected $rules = [
        'brands' => 'required',
        'brand' => 'required',
        'series' => 'required',
        'serie' => 'required',
        'categories.*.name' => ['nullable'],
        'categories.*.price' => ['nullable', 'numeric'],
        'categories.*.min_price' => ['nullable', 'numeric'],
    ];
    public function mount()
    {
        $this->brands = Category::where('parent_id', null)->get();
        $this->brand = $this->brands->first();
        $this->series = Category::where(['parent_id' => $this->brand->id])->get();
        $this->serie = $this->series->first()->id ?? null;
    }
    public function render()
    {
        $this->categories = RateList::where('series_id', '=', $this->serie)->where('name', 'LIKE', "%$this->search%")->with('series')->get();
        return view('livewire.brand-series-search');
    }
    public function editRatelistIndex($ratelistIndex)
    {
        $this->editedRatelistIndex = $ratelistIndex;
    }
    public function updateRatelist($ratelistIndex)
    {
        $ratelist = $this->categories[$ratelistIndex] ?? null;
        if (!is_null($ratelist)) {
            $editedRatelist = RateList::find($ratelist['id']);
            if ($editedRatelist) {
                $editedRatelist->update($ratelist->toArray());
            }
        }
        $this->editedRatelistIndex = null;
    }
    public function updatedBrand($value)
    {
        $this->series = Category::where(['parent_id' => $value])->get();
        $this->serie = $this->series->first()->id ?? null;
        $this->search = '';
    }

    public function updatedSerie()
    {
        $this->search = '';
    }
}
