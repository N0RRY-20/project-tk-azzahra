<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->peran === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            if (Auth::user()->peran === 'guru') {
                return redirect()->route('guru.dashboard');
            }
            if (Auth::user()->peran === 'orangtua') {
                return redirect()->route('orangtua.dashboard');
            }

            return redirect()->intended('dashboard');
        }


        return back()->with('error', 'Login gagal! Silakan periksa username dan password Anda.');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
