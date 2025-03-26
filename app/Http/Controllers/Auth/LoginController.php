<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
         'email' => 'required|email',
        'password' => 'required|string'
        ]);

// dd($validate);
        if (Auth::attempt($validate)){
          $request->session()->regenerate();
     
          return redirect()->route('index');
        }
        
        throw ValidationException::withMessages([
            'Credentials' => 'Sorry incorrect Credentials'
        ]);
       
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('welcome')->with('status', 'You have been logged out');
    }

    //
}
