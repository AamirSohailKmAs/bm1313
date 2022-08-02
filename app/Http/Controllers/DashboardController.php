<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $users_id = [];

        /**
         * @var App\Models\User $user
         */
        $user = auth()->user();
        if ($user->hasRole('admin')) {
            $users = User::where('status', '=', '1')->get();
        } else {
            $users = Auth::user()->currentTeam?->members;
        }
        if ($users) {
            $users_id = $users->pluck('id')->toArray();
        } else {
            $users = [];
        }
        $sales = Sale::whereDate('created_at', date('Y-m-d'))->whereIn('user_id', $users_id)->with('user')->orderBy('total', 'DESC')->get();
        foreach ($sales as $sale) {
            $sale->orders = Order::whereDate('created_at', date('Y-m-d'))->where('user_id', $sale->user_id)->count();
        }

        $report['cash'] = $sales->sum('cash');
        $report['mb'] = $sales->sum('mb');
        $report['total'] = $sales->sum('total');
        $report['profit'] = $sales->sum('profit');
        $report['expense'] = $sales->sum('expense');

        $totalTodaySale = $sales->sum('cash');
        $monthlySales = Sale::whereMonth('created_at', date('m'))->whereIn('user_id', $users_id)->get();
        foreach ($users as $user) {
            $user->cash = $monthlySales->where('user_id', $user->id)->sum('cash');
            $user->mb = $monthlySales->where('user_id', $user->id)->sum('mb');
            $user->total = $monthlySales->where('user_id', $user->id)->sum('total');
            $user->profit = $monthlySales->where('user_id', $user->id)->sum('profit');
            $user->expense = $monthlySales->where('user_id', $user->id)->sum('expense');
        }
        // dd($users);
        // dd($sales);
        return view('admin.dashboard', [
            'users' => $users->sortByDesc('total'),
            'sales' => $sales,
            'report' => $report,
            'totalTodaySale' => $totalTodaySale,
        ]);
    }
}
//, 'created_at' => now()