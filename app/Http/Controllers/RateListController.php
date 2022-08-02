<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\RateList;
use Illuminate\Http\Request;
use App\Imports\RateListImport;
use Maatwebsite\Excel\Facades\Excel;

class RateListController extends Controller
{
    public function index()
    {
        return view('ratelist.index');
    }

    public function create()
    {
        $collection =  RateList::with('series')->get();
        return view('ratelist.create', [
            'categoryGroup' => $collection->groupBy('brand_id'),
            'brands' => Category::where('parent_id', null)->get(),
        ]);
    }


    public function store(Request $request)
    {
        RateList::create([
            'name' => $request->name,
            'price' => $request->price,
            'min_price' => $request->min_price,
            'brand_id' => $request->brand,
            'series_id' => $request->series,
        ]);
        return redirect()->route('ratelist.create')->with('success', __('SuccessFull'));
    }
    public function update(Request $request, RateList $rateList)
    {
        dd($rateList);
    }

    public function import(Request $request)
    {
        $request->validate([
            'ratelist_import' => ['required'],
        ]);
        Excel::import(new RateListImport, $request->file('ratelist_import'));
        return redirect()->route('ratelist.create')->with('success', __('SuccessFully Imported'));
    }

    public function destroy(RateList $rateList)
    {
        $rateList->delete();
        return redirect()->route('ratelist.create')->with('success', __('SuccessFully Deleted'));
    }
}
