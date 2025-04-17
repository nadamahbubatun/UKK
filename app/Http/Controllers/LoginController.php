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
            'username' => ['required', 'string', 'max:255'],
            'password' => 'required',
        ]);

        // Coba autentikasi menggunakan username dan password
        if (Auth::attempt(['name' => $request->username, 'password' => $request->password])) {
            // Jika login berhasil, redirect ke halaman home
            return redirect()->route('home')->with('success', 'Login berhasil!');
        }

        // Jika gagal login, kembali ke form login dengan pesan error
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
}
