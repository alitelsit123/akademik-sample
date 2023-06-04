<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
  public function index() {
    return view('auth.login');
  }
  public function login(Request $request) {
    request()->validate([
      'email' => ['required','email'],
      'password' => ['required']
    ]);

    $credentials = request()->only(['email','password']);

    if (auth()->attempt($credentials)) {
      $request->session()->regenerate();
      $url = 'admin/dashboard';
      if (auth()->user()->level == 'admin') {
        $url = 'admin';
      } else if(auth()->user()->level == 'teacher') {
        $url = 'teacher';
      } else {
        $url = 'head';
      }

      return redirect()->intended($url);
    }

    return back()->withErrors([
      'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
  }
  public function logout() {
    auth()->logout();
    return redirect(route('login'));
  }
}
