<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Ambil data user yang sedang login
        $boards = $user->boards; // Ambil semua board milik user

        return view('profile.index', compact('user', 'boards'));
    }
}
