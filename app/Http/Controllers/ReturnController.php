<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnController extends Controller
{
    public function create()
    {
        return view('orders.return', [
            'orders' => Order::where(['user_id' => auth()->user()->id])->whereDate('created_at', today())
                ->latest()->get(),
            'fromDate' => null,
            'toDate' =>  null,
        ]);
    }

    public function store(Request $request)
    {
        $orders = Order::where(['user_id' => auth()->user()->id])->whereRaw(
            "(created_at >= ? AND created_at <= ?)",
            [
                $request->fromDate . " 00:00:00",
                $request->toDate . " 23:59:59"
            ]
        )->latest()->get();
        return view('orders.return', [
            'orders' => $orders,
            'fromDate' => $request->fromDate,
            'toDate' =>  $request->toDate,
        ]);
    }
    public function update(Order $order)
    {
        DB::transaction(function () use ($order) {
            $sale = Sale::where(['user_id' => auth()->user()->id])->wheredate('created_at', $order->created_at->toDateString())->firstOrFail();
            $sale->cash -= ($order->qty * $order->cash);
            $sale->mb -= ($order->qty * $order->mb);
            $sale->total -= $order->payment;
            $sale->profit -= $order->t_profit;
            // if (date('Y-m-d') == $order->created_at->toDateString()) {
            //     $sale->cash_drawer -= ($order->qty * $order->cash);
            // }
            $sale->cash_drawer -= ($order->qty * $order->cash);
            $sale->save();
            $order->returned_at = now();
            $order->save();
        });
        return redirect()->route('orders.create')->withSuccess(__('Order Returned'));
    }

    public function detail(User $user)
    {
        return view('orders.details', [
            'user' => $user,
            'orders' => Order::where(['user_id' => $user->id])->whereDate('created_at', today())
                ->latest()->get(),
            'fromDate' => null,
            'toDate' =>  null,
        ]);
    }

    public function detail_update(Request $request, User $user)
    {
        $orders = Order::where(['user_id' => $user->id])->whereRaw(
            "(created_at >= ? AND created_at <= ?)",
            [
                $request->fromDate . " 00:00:00",
                $request->toDate . " 23:59:59"
            ]
        )->latest()->get();
        return view('orders.details', [
            'user' => $user,
            'orders' => $orders,
            'fromDate' => $request->fromDate,
            'toDate' =>  $request->toDate,
        ]);
    }
}
