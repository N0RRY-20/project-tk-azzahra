<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:100|min:6',
                'phone' => 'required|digits_between:6,20',
                'username' => 'required|string|max:50|min:6|unique:users,username',
                'password' => 'required|string|min:6|confirmed',
            ]

        );
        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login untuk melanjutkan.');
    }
}
