<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListTask;
use App\Models\Board;

class ListTaskController extends Controller
{
    public function store(Request $request, $boardId)
    {
        $request->validate([
            'name' => 'required',
        ]);

        ListTask::create([
            'name' => $request->name,
            'board_id' => $boardId,
        ]);

        return redirect()->back()->with('success', 'List berhasil ditambahkan!');
    }
    public function show($boardId, $listId)
    {
        return redirect()->route('tasks.index', [
            'boardId' => $boardId,
            'listId' => $listId
        ]);
    }
    public function update(Request $request, $listId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $list = ListTask::findOrFail($listId);
        $list->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'List berhasil diperbarui');
    }

    // Delete List
    public function destroy($listId)
    {
        $list = ListTask::findOrFail($listId);
        $list->delete();

        return redirect()->back()->with('success', 'List berhasil dihapus');
    }
    
}
