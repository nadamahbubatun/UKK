<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board; // Tambahkan ini

class BoardController extends Controller
{
    public function index()
    {
        $boards = Board::where('user_id', auth()->id())->get(); // ⬅️ filter berdasarkan user
        return view('dashboard.board', compact('boards'));
    }
    

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
    
        Board::create([
            'name' => $request->name,
            'user_id' => auth()->id(), // ⬅️ penting!
        ]);
    
        return redirect()->back()->with('success', 'Board berhasil dibuat!');
    }
    
    public function show($id)
    {
        $board = Board::where('user_id', auth()->id())
                      ->with('lists')
                      ->findOrFail($id);
        return view('dashboard.boarddetail', compact('board'));
    }
    
    
    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required']);
        $board = Board::where('user_id', auth()->id())->findOrFail($id);

        $board->update($request->all());
        return redirect()->back()->with('success', 'Board berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $board = Board::where('user_id', auth()->id())->findOrFail($id);

        $board->delete();
        return redirect()->back()->with('success', 'Board berhasil dihapus!');
    }
}

