<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/home";

    /**
     * 
     * Redirects to dashboard of role
     * 
     */


    protected function redirectTo()
    {
        $role = Auth::user()->roles->pluck('name');
        return '/' . $role[0] . '/dashboard';
    }


    protected function showLoginForm()
    {
        return Inertia::render("User/LoginPage");
    }

    /**
     * 
     * Overwriting loggedOut method
     * 
     * Redirects to login page
     * 
     */

    protected function loggedOut()
    {
        return Redirect::route("login");
    }

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
