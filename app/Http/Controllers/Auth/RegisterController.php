<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use PDO;

class RegisterController extends Controller
{
    public function showRegister(){
        return view('auth.register');
    }


    public function register(Request $request)
    {
      $validate = $request->validate([
        'name' => 'required|string|max:255', 
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6|confirmed'
      ]);


      $user = User::create([
        'name' => $validate['name'],
        'email' => $validate['email'], // Associative array 
        'password' => Hash::make($validate['password']), 
    ]); 

      Auth::login($user);
      return redirect()->route('index');
    }

    public function welcome()
    {
        return view('welcome');
    }
    
    
}
