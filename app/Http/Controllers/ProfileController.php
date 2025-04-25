<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user(); 
        $boards = $user->boards; 

        return view('profile.index', compact('user', 'boards'));
    }
}
