<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Qnhu_Controller extends Controller
{
    public function showLogin() {
   
        App::setLocale('vi');
        return view('auth.login');
    }

  
    public function showRegister() {
      
        App::setLocale('vi');
        return view('auth.register');
    }

   
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}