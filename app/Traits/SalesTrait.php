<?php

namespace App\Traits;

use App\Models\Sale;
use App\Models\Order;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Movement;
use App\Models\Activation;
use App\Models\Credit;
use App\Models\Withdraw;

trait SalesTrait
{
  /**
   * @param string $user
   * @param string $startDate
   * @param string $endDate
   * 
   * @return array
   */
  public function stats(string $user, string $startDate, string $endDate): array
  {
    $products = Product::get();
    $activations = Activation::get();
    $movements = Movement::get();
    $orders = Order::where(['user_id' => $user, 'returned_at' => null])
      ->whereDate('created_at', '>=', $startDate)
      ->whereDate('created_at', '<=', $endDate)
      ->get();
    $expenses = Expense::where(['user_id' => $user])
      ->whereDate('created_at', '>=', $startDate)
      ->whereDate('created_at', '<=', $endDate)
      ->get();

    $withdraws = Withdraw::where(['user_id' => $user])
      ->whereDate('created_at', '>=', $startDate)
      ->whereDate('created_at', '<=', $endDate)
      ->get();

    $credits = Credit::where(['user_id' => $user])
      ->whereDate('created_at', '>=', $startDate)
      ->whereDate('created_at', '<=', $endDate)
      ->get();

    foreach ($products as $product) {
      $product->qty = $orders->where('product_id', $product->id)->sum('qty');
      $product->t_cost = $orders->where('product_id', $product->id)->sum('t_cost');
      $product->payment = $orders->where('product_id', $product->id)->sum('payment');
      $product->t_profit = $orders->where('product_id', $product->id)->sum('t_profit');
    }
    foreach ($activations as $activation) {
      $activation->qty = $orders->where('activation_id', $activation->id)->sum('qty');
      $activation->t_cost = $orders->where('activation_id', $activation->id)->sum('t_cost');
      $activation->payment = $orders->where('activation_id', $activation->id)->sum('payment');
      $activation->t_profit = $orders->where('activation_id', $activation->id)->sum('t_profit');
    }
    foreach ($movements as $movement) {
      $movement->qty = $expenses->where('movement_id', $movement->id)->sum('qty');
      $movement->total = $expenses->where('movement_id', $movement->id)->sum('total');
    }
    $sales = Sale::where(['user_id' => $user])
      ->whereDate('created_at', '>=', $startDate)
      ->whereDate('created_at', '<=', $endDate)
      ->get();

    foreach ($sales as $sale) {
      $sale->customers = Order::where('user_id', $user)
        ->whereDate('created_at', '=', $sale->created_at->toDateString())
        ->count();
    }

    $report['cash'] = $sales->sum('cash');
    $report['mb'] = $sales->sum('mb');
    $report['total'] = $sales->sum('total');
    $report['profit'] = $sales->sum('profit');
    $report['expense'] = $sales->sum('expense');
    $report['customers'] = $sales->sum('customers');

    $report['credit'] = $credits->sum('amount');

    $report['last_withdraw_at'] = ($withdraws->last()) ? $withdraws->last()->created_at : null;
    $report['withdrawn'] = $withdraws->sum('withdraw');
    $report['due'] = round($report['credit'] + $report['cash'] - $report['expense'] - $report['withdrawn'], 2);

    return [
      'startDate' => $startDate,
      'endDate' => $endDate,
      'user' => $user,
      'sales' => $sales,
      'report' => $report,
      'credits' => $credits,
      'withdraws' => $withdraws,
      'products' => $products,
      'movements' => $movements,
      'activations' => $activations,
    ];
  }
}
