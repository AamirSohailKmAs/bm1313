<?php

use App\Http\Controllers\ActivationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PosDropdownController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RateListController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\Teamwork\TeamController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::view('/', 'auth.login')->name('home');
    Route::post('/', [LoginController::class, 'store'])->name('login');
});

Route::group(['middleware' => ['auth', 'permission']], function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::get('pos-dropdown', [PosDropdownController::class, 'index'])->name('pos.dropdown');
    Route::resource('activations', ActivationController::class)->only('store');
    Route::resource('products', ProductController::class)->only('store');
    Route::resource('movements', MovementController::class)->only('store');

    Route::post('ratelist/import', [RateListController::class, 'import'])->name('ratelist.import');

    Route::get('ratelist', [RateListController::class, 'index'])->name('ratelist.index');
    Route::get('ratelist/create', [RateListController::class, 'create'])->name('ratelist.create');
    Route::post('ratelist', [RateListController::class, 'store'])->name('ratelist.store');

    Route::post('ratelist/{rateList}/update', [RateListController::class, 'update'])->name('ratelist.update');

    Route::delete('ratelist/{rateList}', [RateListController::class, 'destroy'])->name('ratelist.destroy');

    Route::post('tickets/history', [TicketController::class, 'history'])->name('tickets.history');
    // Route::get('tickets/cdtho', [TicketController::class, 'cdtho'])->name('tickets.cdtho');
    // Route::post('tickets/cdtho', [TicketController::class, 'cdtho_update'])->name('tickets.cdtho');
    Route::resources([
        'roles' => RoleController::class,
        'teams' => TeamController::class,
        'permissions' => PermissionController::class,
    ]);
    Route::post('categories/import', [CategoryController::class, 'import'])->name('categories.import');
    // Route::post('categories/series', [CategoryController::class, 'series'])->name('categories.series');
    Route::resource('categories', CategoryController::class)->only(['create', 'store', 'destroy']);
    Route::resource('tickets', TicketController::class)->except(['edit', 'update']);
    Route::resource('orders', OrderController::class)->except(['show']);
    Route::resource('users', UserController::class)->except(['show', 'destroy']);
    Route::resource('withdraws', WithdrawController::class)->only(['store', 'destroy']);
    Route::resource('expenses', ExpenseController::class)->except(['index', 'show']);
    Route::resource('credits', CreditController::class)->except(['index', 'show']);
    Route::get('summary/{user}', [SaleController::class, 'index'])->name('sales.index');
    Route::post('summary/{user}', [SaleController::class, 'show']);
    Route::get('return', [ReturnController::class, 'create'])->name('return.create');
    Route::post('return', [ReturnController::class, 'store'])->name('return.store');
    Route::get('details/{user}', [ReturnController::class, 'detail'])->name('return.details');
    Route::post('details/{user}', [ReturnController::class, 'detail_update'])->name('return.details.filter');
    Route::patch('return/{order}/', [ReturnController::class, 'update'])->name('return.update');
    Route::get('logout', LogoutController::class)->name('logout');
});
