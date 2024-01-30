<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
 // create user

public function create(){
   return view('users.register');
}

// Store User
public function store(Request $request){
    $formFields = $request->validate([
        'name' => 'required|min:3',
        'email' =>  ['required', 'email', Rule::unique('users', 'email')],
        'password' => 'required|confirmed|min:6',

  ]);

       $user = User::create($formFields);
       auth()->login($user);
       return redirect('/')->with('message' , 'User Created and Loged in');
}
public function logout(Request $request){
      auth()->logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return redirect('/')->with('message', 'You have been logged out!');
}

// Login Form
public function login(){
    return view('users.login');
}

// Auth User
public function authenticate(Request $request){
    $formFields = $request->validate([
        'email' =>  ['required', 'email'],
        'password' => 'required',

  ]);

  if(auth()->attempt($formFields)){
      $request->session()->regenerate();
      return redirect('/')->with('message', 'You are now logged in!');
  }
      return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput();
}

}
