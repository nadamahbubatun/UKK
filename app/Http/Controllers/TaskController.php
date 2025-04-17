<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\ListTask; // Model untuk list
use Illuminate\Http\Request;
use App\Models\Board;  // Pastikan Board di-import di sini


class TaskController extends Controller
{
    public function index($boardId, $listId)
    {
        $tasks = Task::where('list_id', $listId)->get();
        $lists = ListTask::findOrFail($listId);
        $boards = Board::findOrFail($boardId);
    
        // Pastikan listId dan boardId diteruskan ke view
        return view('dashboard.listdetail', compact('tasks', 'lists', 'boards', 'boardId', 'listId'));
    }
    
    
    // Menampilkan form tambah task
    public function create($boardId, $listId)
    {
        $lists = ListTask::where('board_id', $boardId)->get();
        return view('tasks.create', compact('lists', 'boardId', 'listId'));
    }
    
    

    // Menyimpan task ke database
    public function store(Request $request, $boardId, $listId)
    {
        $request->validate([
            'name' => 'required|string',
            'priority' => 'required|in:Rendah,Sedang,Tinggi',
            'status' => 'required|in:Belum Selesai,Selesai',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);
        
        // Create task and associate with the correct board and list
        Task::create([
            'name' => $request->name,
            'priority' => $request->priority,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'list_id' => $listId, // Set the list_id to the listId parameter
        ]);
        
        return redirect()->route('tasks.index', [
            'boardId' => $boardId,
            'listId' => $listId
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
    // Temukan task berdasarkan ID
    $task = Task::findOrFail($id);
    $task->delete();

    // Redirect atau lakukan hal lain
    return redirect()->route('tasks.index', ['boardId' => $boardId, 'listId' => $listId])
        ->with('success', 'Task berhasil dihapus!');
}

public function showCalendar()
{
    return view('calendar.index'); // Menampilkan halaman kalender
}

public function getCalendarEvents()
{
    // Ambil data task yang sudah ada di database
    $tasks = Task::all();
    
    // Format data task agar bisa digunakan di FullCalendar
    $events = $tasks->map(function($task) {
        return [
            'title' => $task->name,
            'start' => $task->start_date, // atau task->end_date jika ada
            'end' => $task->end_date, // jika ada end_date
            'description' => $task->description,
        ];
    });
    
    // Kirim response berupa JSON
    return response()->json($events);
}
}

