<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function showLoginForm()
    {
        return view('index'); 
    }

    /**
     * Proses login pengguna.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'password' => 'required',
        ]);

      
        if (Auth::attempt(['name' => $request->username, 'password' => $request->password])) {
      
            return redirect()->route('home')->with('success', 'Login berhasil!');
        }

     
        return back()->withErrors(['username' => 'Username atau password salah'])->withInput();
    }

    /**
     * Proses logout pengguna.
     */
    // public function logout()
    // {
    //     Auth::logout();
    //     return redirect()->route('login')->with('success', 'Anda telah logout.');
    // }
    public function logout(Request $request)
{
    Auth::logout();
    return redirect('/login');
}
}
