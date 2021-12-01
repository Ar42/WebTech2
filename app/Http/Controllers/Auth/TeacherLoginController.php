<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class TeacherLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:teacher')->except('logout');
    }
    
    public function showLoginForm()
    {
        return view('auth.teacher_login');
    }

    public function login(Request $request)
    {
        //Validate the form data

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        //Attempt to log the user in
        
        if (Auth::guard('teacher')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember))
        {
            // successful-> redirect to intended location

            return redirect()->intended(route('teacher_home'));
        }

        return redirect()->back()->withInput($request->only('username', 'remember'));

    }

    public function logout()
    {
        Auth::guard('teacher')->logout();
        return redirect('/');
    }
}
