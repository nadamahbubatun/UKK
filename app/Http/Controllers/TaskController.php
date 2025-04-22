<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\ListTask; // Model untuk list
use Illuminate\Http\Request;
use App\Models\Board;  // Pastikan Board di-import di sini
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index(Request $request, $boardId, $listId)
    {
        $search = $request->input('search');
        $status = $request->input('status'); // Ambil filter status
    
        $tasks = Task::where('list_id', $listId)
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->get();
    
        $lists = ListTask::findOrFail($listId);
        $boards = Board::findOrFail($boardId);
        $notifications = $this->getUpcomingDeadlines();

        return view('dashboard.listdetail', compact('tasks', 'lists', 'boards', 'boardId', 'listId','notifications'));
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
            'status' => 'required|in:Belum Selesai,On Progress,Selesai',
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
            'user_id' => auth()->id(),
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
    
        switch ($task->status) {
            case 'Belum Selesai':
                $task->status = 'On Progress';
                break;
            case 'On Progress':
                $task->status = 'Selesai';
                break;
            case 'Selesai':
            default:
                $task->status = 'Belum Selesai';
                break;
        }
    
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
            'status' => 'required|in:Belum Selesai,On Progress,Selesai',
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
    $tasks = Task::where('user_id', auth()->id())->get();

    $events = $tasks->filter(function ($task) {
        // Pastikan hanya task yang punya tanggal mulai yang diproses
        return !is_null($task->start_date);
    })->map(function ($task) {
        return [
            'title' => $task->name,
            'start' => \Carbon\Carbon::parse($task->start_date)->toDateString(),
            'end' => $task->end_date 
                ? \Carbon\Carbon::parse($task->end_date)->addDay()->toDateString() 
                : null, // end bersifat opsional, tapi jika ada ditambahkan 1 hari agar inklusif
            'description' => $task->description,
        ];
    })->values(); // reset index array

    return response()->json($events);
}



public function getUpcomingDeadlines()
{
    $today = Carbon::today();
    $threshold = Carbon::today()->addDays(3); // batas 3 hari ke depan

    $tasks = Task::where('user_id', auth()->id())
        ->whereNotNull('end_date')
        ->whereBetween('end_date', [$today, $threshold])
        ->whereIn('status', ['Belum Selesai', 'On Progress', 'Selesai'])
        ->get();

    return $tasks;
}


}

