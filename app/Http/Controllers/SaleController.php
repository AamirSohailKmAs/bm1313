<?php

namespace App\Http\Controllers;

use App\Traits\SalesTrait;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    use SalesTrait;

    public function index(string $user)
    {
        $result = $this->stats($user, date('Y-m-01'), date('Y-m-t'));

        // dd($result);
        /**
         * @var App\Models\User $authUser
         */
        $authUser = auth()->user();
        if ($authUser->can('dashboard')) {
            return view('sales.admin-sales', $result);
        }
        return view('sales.index', $result);
    }

    public function show(Request $request, string $user)
    {
        $request->validate([
            'startDate' => ['required'],
            'endDate' => ['required'],
        ]);

        $result = $this->stats($user, $request->startDate, $request->endDate);
        /**
         * @var App\Models\User $authUser
         */
        $authUser = auth()->user();
        if ($authUser->can('dashboard')) {
            return view('sales.admin-sales', $result);
        }
        return view('sales.index', $result);
    }
}
