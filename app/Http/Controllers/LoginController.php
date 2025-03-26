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
        return view('index'); // Ganti dengan nama view login jika berbeda
    }

    /**
     * Proses login pengguna.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba autentikasi
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }

    /**
     * Proses logout pengguna.
     */
    // public function logout()
    // {
    //     Auth::logout();
    //     return redirect()->route('login')->with('success', 'Anda telah logout.');
    // }
}
