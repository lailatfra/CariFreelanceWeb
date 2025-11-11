<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.loginadmin'); // view form login admin
    }

    public function dashboard()
    {
        return view('admin.dashboard'); // blade-nya
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_logged_in');
        return redirect()->route('login.admin');
    }
}
