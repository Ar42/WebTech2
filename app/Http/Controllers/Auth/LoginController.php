<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
    //protected $redirectTo = RouteServiceProvider::HOME;

    public function login(Request $request)
    {
        //Validate the form data
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        //Attempt to log the user in
        
        if (Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember))
        {
            // successful-> redirect to intended location
            return redirect()->intended(route('home'));
        }
        return redirect()->back();
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout', 'adminLogout');
    }
    public function username()
    {
        return 'username';
    }
    public function adminLogout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
