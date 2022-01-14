<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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

//    protected $redirectTo = RouteServiceProvider::HOME;

    public function redirectTo(){
        $role = Auth::user()->role;
        switch ($role){
            case "admin":
                return "/homeAdminDash";
                break;
            case "writer":
                return "/homeWriterDash";
                break;
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // ####### this function I bring it to redirect the path after logout to login route #######
    public function logout()
    {
        $this->guard()->logout();
        return redirect('/login');
    }
}
