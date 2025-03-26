<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\ListTask; // Model untuk list
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index($boardId, $listId)
    {
        $tasks = Task::where('list_id', $listId)->get();
        $lists = ListTask::findOrFail($listId);
        $boards = \App\Models\Board::findOrFail($boardId);
        
        return view('dashboard.listdetail', compact('tasks', 'lists', 'boards'));
    }
    
    
    // Menampilkan form tambah task
    public function create($boardId, $listId)
    {
        $lists = \App\Models\ListTask::where('board_id', $boardId)->get();
    
        return view('tasks.create', compact('lists', 'boardId', 'listId'));
    }
    

    // Menyimpan task ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'list_id' => 'required|exists:lists,id',
            'priority' => 'required|in:Rendah,Sedang,Tinggi',
            'status' => 'required|in:Belum Selesai,Selesai',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);
    
        Task::create($request->all());
    
        return redirect()->route('tasks.index', [
            'boardId' => $request->board_id,
            'listId' => $request->list_id
        ])->with('success', 'Task berhasil ditambahkan!');
    }
    
    
    public function showTasks() {
        $tasks = Task::with('lists')->get(); // Pastikan relasi 'list' sudah benar
        return view('tasks.index', compact('tasks'));
    }

    public function view($id)
    {
        $tasks = Task::find($id);

        if ($tasks) {
            return view('tasks.view', compact('tasks'));
        } else {
            return redirect()->route('barang.index')->with('error', 'Data barang tidak ditemukan');
        }
    }
    public function updateStatus($id)
    {
        $task = Task::findOrFail($id);
        $task->status = $task->status === 'Belum Selesai' ? 'Selesai' : 'Belum Selesai';
        $task->save();
    
        return redirect()->back()->with('success', 'Status task berhasil diubah!');
    }
    public function edit($boardId, $listId, $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task', 'boardId', 'listId'));
    }
    

     public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'priority' => 'required|in:Rendah,Sedang,Tinggi',
            'status' => 'required|in:Belum Selesai,Selesai',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());

        return redirect()->route('tasks.index', [
            'boardId' => $task->list->board_id,
            'listId' => $task->list_id
        ])->with('success', 'Task berhasil diperbarui!');
    }

    // Menghapus task

    public function destroy($boardId, $listId, $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->back()->with('success', 'Task berhasil dihapus!', compact('task', 'boardId', 'listId'));
    }

    
}

