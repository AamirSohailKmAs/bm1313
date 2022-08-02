<?php

namespace App\Http\Controllers;

use App\Models\Activation;
use Illuminate\Http\Request;

class ActivationController extends Controller
{
    public function store(Request $request)
    {
        if ($request->id) {
            $request->validate([
                'name' => ['required', 'unique:activations,name,' . $request->id]
            ]);
            Activation::findOrFail($request->id)->update(['name' => $request->name]);
        } else {
            $request->validate([
                'name' => ['required', 'unique:activations,name']
            ]);

            Activation::create([
                'name' => $request->name,
            ]);
        }
        return redirect()->route('pos.dropdown')->with('success', __('Activation Added'));
    }
}
