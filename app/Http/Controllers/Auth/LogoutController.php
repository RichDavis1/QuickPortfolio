<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LogoutController extends Controller
{
    /**
     * Where to redirect users after logging out.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Logging out current signed in user.
     */
    public function logout() : void
    {
        Auth::logout();
    }
}
