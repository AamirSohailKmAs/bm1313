<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseStoreRequest;
use App\Http\Requests\ExpenseUpdateRequest;
use App\Models\Activation;
use App\Models\Expense;
use App\Models\Movement;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function store(ExpenseStoreRequest $request)
    {
        $total = $request->expense_qty * $request->expense_price;
        $sale = Sale::where(['user_id' => auth()->id()])->wheredate('created_at', today())->firstOrFail();
        if ($sale->cash_drawer < $total) {
            return back()->withErrors(__('Cash is Low in Cash Drawer'));
        }
        DB::transaction(function () use ($request, $total, $sale) {
            Expense::create([
                'user_id' => auth()->id(),
                'qty' => $request->expense_qty,
                'movement_id' => $request->expense_item,
                'unit_price' => $request->expense_price,
                'remarks' => $request->expense_remarks,
                'total' => $total,
            ]);
            $sale->expense += $total;
            $sale->cash_drawer -= $total;
            $sale->cash_withdraw += $total;
            $sale->save();
        });
        return redirect()->route('orders.create');
    }

    public function edit(Expense $expense)
    {
        return view('expenses.edit', [
            'expense' => $expense,
            'expenses' => Expense::where(['user_id' => auth()->user()->id])
                ->whereDate('created_at', date('Y-m-d'))->get(),
            'activations' => Activation::get(),
            'products' => Product::get(),
            'movements' => Movement::get(),
            'orders' => Order::with('activation', 'product')
                ->where(['user_id' => auth()->user()->id])
                ->whereDate('created_at', date('Y-m-d'))->get(),
        ]);
    }

    public function update(ExpenseUpdateRequest $request, Expense $expense)
    {
        $total = $request->expense_qty * $request->expense_price;
        $sale = Sale::where(['user_id' => auth()->user()->id])->wheredate('created_at', $expense->created_at->toDateString())->firstOrFail();
        if ($sale->cash_drawer < $total) {
            return redirect(url()->previous())->withErrors(__('Cash is Low in Cash Drawer'));
        }
        DB::transaction(function () use ($request, $expense, $total, $sale) {
            if ($request->expense_qty != $expense->qty || $request->expense_price != $expense->unit_price) {
                $sale->expense += ($total - $expense->total);
                $sale->cash_drawer -= ($total - $expense->total);
                $sale->cash_withdraw += ($total - $expense->total);
                $sale->save();
            }
            $expense->qty = $request->expense_qty;
            $expense->movement_id = $request->expense_item;
            $expense->unit_price = $request->expense_price;
            $expense->remarks = $request->expense_remarks;
            $expense->total = $total;
            $expense->save();
        });
        return redirect()->route('orders.create');
    }

    public function destroy(Expense $expense)
    {
        $sale = Sale::where(['user_id' => auth()->id()])->wheredate('created_at', $expense->created_at->toDateString())->firstOrFail();
        $sale->expense -= $expense->total;
        $sale->cash_drawer += $expense->total;
        $sale->cash_withdraw -= $expense->total;
        $sale->save();
        $expense->delete();
        return redirect()->route('orders.create');
    }
}
