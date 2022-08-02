<?php

namespace App\Http\Controllers;

use App\Imports\CategoryImport;
use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    public function create()
    {
        $collection =  Category::with('parent')->get();
        // dd($collection->where('parent_id', null));
        return view('categories.create', [
            'categoryGroup' => $collection->whereNotNull('parent_id')->groupBy('parent_id'),
            'brands' => $collection->where('parent_id', null),
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => ['required'],
            'brand' => ['nullable', 'required_with:series', 'integer']
        ]);
        $parent_id = null;
        if ($request->series) {
            $parent_id = $request->brand;
        }
        Category::create([
            'name' => $request->name,
            'parent_id' => $parent_id,
        ]);
        return redirect()->route('categories.create')->withSuccess(__('Category Created Successfully'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'category_import' => ['required', 'mimes:xlsx,csv,xls'],
        ]);
        Excel::import(new CategoryImport, $request->file('category_import'));
        return redirect()->route('categories.create')->withSuccess(__('Categories Imported Successfully'));
    }

    public function series(Request $request)
    {
        $series = Category::where(['parent_id' => $request->category])->get();
        $result = "";
        foreach ($series as $s) {
            $result .= "<option value='$s->id'>$s->name</option>";
        }
        return $result;
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.create')->with('success', __('Successfully Deleted'));
    }
}
