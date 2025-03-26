<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board; // Tambahkan ini

class BoardController extends Controller
{
    public function index()
    {
        // Ambil semua board dari database
        $boards = Board::all();

        // Kirim data boards ke view
        return view('dashboard.board', compact('boards'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Board::create($request->all());
        return redirect()->back()->with('success', 'Board berhasil dibuat!');
    }
    public function show($id)
    {
        $board = Board::with('lists')->findOrFail($id);
        return view('dashboard.boarddetail', compact('board'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required']);
        $board = Board::findOrFail($id);
        $board->update($request->all());
        return redirect()->back()->with('success', 'Board berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $board = Board::findOrFail($id);
        $board->delete();
        return redirect()->back()->with('success', 'Board berhasil dihapus!');
    }
}

