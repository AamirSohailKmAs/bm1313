<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Activation;
use App\Models\Expense;
use App\Models\Movement;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index', [
            'orders' => Order::where(['user_id' => auth()->user()->id])
                ->whereDate('created_at', date('Y-m-d'))->get(),
            'expenses' => Expense::where(['user_id' => auth()->user()->id])
                ->whereDate('created_at', date('Y-m-d'))->get(),
            'activations' => Activation::get(),
            'products' => Product::get(),
            'movements' => Movement::get(),
        ]);
    }

    public function create()
    {
        $sale = Sale::where(['user_id' => auth()->id()])->wheredate('created_at', date('Y-m-d'))->firstOrNew([
            'user_id' => auth()->id(),
        ]);
        $sale->save();
        return view('orders.create', [
            'sale' => $sale,
            'expenses' => Expense::where(['user_id' => auth()->user()->id])
                ->whereDate('created_at', date('Y-m-d'))->get(),
            'orders' => Order::with('activation', 'product')
                ->where(['user_id' => auth()->user()->id])
                ->whereDate('created_at', date('Y-m-d'))->get(),
            'activations' => Activation::get(),
            'products' => Product::get(),
            'movements' => Movement::get(),
        ]);
    }

    public function store(OrderStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $order = new Order;
            $order->user_id = auth()->user()->id;
            $order->qty = $request->qty;
            $order->activation_id = $request->activation;
            $order->product_id  = $request->product;
            $order->details  = $request->details;
            $order->cash  = $request->cash;
            $order->mb  = $request->mb;
            $order->unit_cost  = $request->unit_cost;
            $t_cash = $request->qty * $request->cash;
            $t_mb = $request->qty * $request->mb;
            $order->payment  = $t_cash + $t_mb;
            $order->t_cost  = $request->qty * $request->unit_cost;
            $order->t_profit  = $order->payment - $order->t_cost;
            $order->save();
            $sale = Sale::where(['user_id' => auth()->id()])->wheredate('created_at', date('Y-m-d'))->firstOrFail();
            // if ($sale == null) {
            //     $sale = new Sale;
            // }
            // $sale->user_id = auth()->user()->id;
            $sale->cash += $t_cash;
            $sale->mb += $t_mb;
            $sale->cash_drawer += $t_cash;
            $sale->total += ($t_mb + $t_cash);
            $sale->profit += $order->t_profit;
            $sale->save();
        });
        return redirect()->route('orders.create');
    }

    public function edit(Order $order)
    {
        return view('orders.edit', [
            'order' => $order,
            'orders' => Order::where(['user_id' => auth()->user()->id])
                ->whereDate('created_at', date('Y-m-d'))->get(),
            'expenses' => Expense::where(['user_id' => auth()->user()->id])
                ->whereDate('created_at', date('Y-m-d'))->get(),
            'activations' => Activation::get(),
            'products' => Product::get(),
        ]);
    }

    public function update(OrderUpdateRequest $request, Order $order)
    {
        DB::transaction(function () use ($request, $order) {
            $request_t_cash = $request->qty * $request->cash;
            $request_t_mb = $request->qty * $request->mb;

            $sale = Sale::where(['user_id' => auth()->user()->id])
                ->wheredate('created_at', $order->created_at->toDateString())->firstOrFail();

            if ($order->qty  != $request->qty || $order->cash  != $request->cash || $order->mb  != $request->mb || $order->unit_cost  != $request->unit_cost) {
                $order_cash = $order->qty * $order->cash;
                $order_mb = $order->qty * $order->mb;
                $sale->cash += ($request_t_cash - $order_cash);
                $sale->mb += ($request_t_mb - $order_mb);
                $sale->cash_drawer += ($request_t_cash - $order_cash);
                $sale->total += ($request_t_mb + $request_t_cash - $order->payment);
                $cost = $request->qty * $request->unit_cost;
                $payment = $request_t_cash + $request_t_mb;
                $profit = $payment - $cost;
                $sale->profit += ($profit - $order->t_profit);
                $sale->save();
            }
            $order->qty = $request->qty;
            $order->activation_id = $request->activation;
            $order->product_id  = $request->product;
            $order->details  = $request->details;
            $order->cash  = $request->cash;
            $order->mb  = $request->mb;
            $order->unit_cost  = $request->unit_cost;
            $order->payment  = $request_t_cash + $request_t_mb;
            $order->t_cost  = $request->qty * $request->unit_cost;
            $order->t_profit  = $order->payment - $order->t_cost;
            $order->save();
        });
        return redirect()->route('orders.create');
    }

    public function destroy(Order $order)
    {
        abort_if($order->user_id != auth()->user()->id, 403);
        if ($order->returned_at) {
            $order->delete();
            return redirect()->route('orders.create');
        }

        DB::transaction(function () use ($order) {
            $sale = Sale::where(['user_id' => auth()->user()->id])->wheredate('created_at', $order->created_at->toDateString())->first();
            $sale->cash -= ($order->qty * $order->cash);
            $sale->mb -= ($order->qty * $order->mb);
            $sale->total -= $order->payment;
            $sale->profit -= $order->t_profit;
            // if (date('Y-m-d') == $order->created_at->toDateString()) {
            //     $sale->cash_drawer -= ($order->qty * $order->cash);
            // }
            $sale->cash_drawer -= ($order->qty * $order->cash);
            $sale->save();
            $order->delete();
        });
        return redirect()->route('orders.create');
    }
}
