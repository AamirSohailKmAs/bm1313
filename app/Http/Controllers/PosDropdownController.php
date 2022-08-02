<?php

namespace App\Http\Controllers;

use App\Models\Activation;
use App\Models\Movement;
use App\Models\Product;

class PosDropdownController extends Controller
{
    public function index()
    {
        return view('pos-dropdown.index', [
            'activations' => Activation::get(),
            'products' => Product::get(),
            'movements' => Movement::get(),

        ]);
    }
}
