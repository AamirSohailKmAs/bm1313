<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Http\Requests\StoreCreditRequest;
use App\Http\Requests\UpdateCreditRequest;

class CreditController extends Controller
{


    public function create()
    {
        return view('credits.create');
    }

    public function store(StoreCreditRequest $request)
    {
        Credit::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'remark' => $request->remark,
        ]);
        return redirect(route('orders.create'))->withInfo(__('Credit Added SuccessFully'));
    }

    public function edit(Credit $credit)
    {
        return view('credits.edit', [
            'credit' => $credit,
        ]);
    }

    public function update(UpdateCreditRequest $request, Credit $credit)
    {
        $credit->update([
            'amount' => $request->amount,
            'remark' => $request->remark,
        ]);
        return redirect(route('orders.create'))->withInfo(__('Credit Updated SuccessFully'));
    }

    public function destroy(Credit $credit)
    {
        $credit->delete();
        return redirect(route('orders.create'))->withInfo(__('Credit Deleted SuccessFully'));
    }
}
