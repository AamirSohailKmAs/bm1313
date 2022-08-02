<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if (!Auth::validate($credentials)) {
            return back()->withInput()->withErrors("Credentials Does not match with our records");
        }
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user, true);
        if (in_array($user->lang, ['en', 'pt', 'el'])) {
            session(['language' => $user->lang]);
        }
        /**
         * @var App\Models\User $user
         */
        if ($user->can('dashboard')) {
            return redirect()->route('dashboard');
        }
        $sale = Sale::where(['user_id' => auth()->id()])->wheredate('created_at', date('Y-m-d'))->firstOrNew([
            'user_id' => auth()->id(),
        ]);
        $sale->save();
        return redirect()->route('orders.create');
    }
}
