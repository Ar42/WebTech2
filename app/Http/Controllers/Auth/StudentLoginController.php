<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class StudentLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:student')->except('logout');
    }
    
    public function showLoginForm()
    {
        return view('auth.student_login');
    }

    public function login(Request $request)
    {
        //Validate the form data

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        //Attempt to log the user in
        
        if (Auth::guard('student')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember))
        {
            // successful-> redirect to intended location

            return redirect()->intended(route('student_home'));
        }

        return redirect()->back()->withInput($request->only('username', 'remember'));

    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect('/');
    }
}
