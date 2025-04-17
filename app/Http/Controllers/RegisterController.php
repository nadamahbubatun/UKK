<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Menampilkan halaman registrasi.
     */
    public function showRegistrationForm()
    {
        return view('register.register');
    }

    /**
     * Menangani proses registrasi pengguna baru.
     */
    public function register(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8'],
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Buat user baru
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    event(new Registered($user));

    // ✅ Jangan login otomatis
    // auth()->login($user); <-- HAPUS baris ini

    // ✅ Redirect ke halaman login
    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
}

    
}
 