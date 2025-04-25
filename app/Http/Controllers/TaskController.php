<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\ListTask; 
use Illuminate\Http\Request;
use App\Models\Board;  
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index(Request $request, $boardId, $listId)
    {
        $search = $request->input('search');
        $status = $request->input('status'); 
        $deadline = $request->input('deadline');
    
        $tasks = Task::where('list_id', $listId)
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($deadline, function ($query, $deadline) {
                $today = Carbon::today();
                if ($deadline == 'mendekati') {
                    // Filter untuk task yang deadline-nya mendekati (dalam 3 hari ke depan)
                    $threshold = $today->addDays(3);
                    return $query->whereBetween('end_date', [$today, $threshold]);
                } elseif ($deadline == 'jauh') {
                    // Filter untuk task yang deadline-nya lebih dari 3 hari lagi
                    $threshold = $today->addDays(3);
                    return $query->where('end_date', '>', $threshold);
                }
            })
            ->get();
    
        $lists = ListTask::findOrFail($listId);
        $boards = Board::findOrFail($boardId);
        $notifications = $this->getUpcomingDeadlines();

        return view('dashboard.listdetail', compact('tasks', 'lists', 'boards', 'boardId', 'listId','notifications'));
    }
    
    

    public function create($boardId, $listId)
    {
        $lists = ListTask::where('board_id', $boardId)->get();
        return view('tasks.create', compact('lists', 'boardId', 'listId'));
    }
    
    

    
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
        

        Task::create([
            'name' => $request->name,
            'priority' => $request->priority,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'list_id' => $listId, 
            'user_id' => auth()->id(),
        ]);
        
        return redirect()->route('tasks.index', [
            'boardId' => $boardId,
            'listId' => $listId
        ])->with('success', 'Task berhasil ditambahkan!');
    }
    
    
    public function showTasks() {
        $tasks = Task::with('lists')->get(); 
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

   

    public function destroy($boardId, $listId, $id)
{
    
    $task = Task::findOrFail($id);
    $task->delete();


    return redirect()->route('tasks.index', ['boardId' => $boardId, 'listId' => $listId])
        ->with('success', 'Task berhasil dihapus!');
}

public function showCalendar()
{
    return view('calendar.index');
}

public function getCalendarEvents()
{
    $tasks = Task::where('user_id', auth()->id())->get();

    $events = $tasks->filter(function ($task) {

        return !is_null($task->start_date);
    })->map(function ($task) {
        return [
            'title' => $task->name,
            'start' => \Carbon\Carbon::parse($task->start_date)->toDateString(),
            'end' => $task->end_date 
                ? \Carbon\Carbon::parse($task->end_date)->addDay()->toDateString() 
                : null, // 
            'description' => $task->description,
        ];
    })->values(); 

    return response()->json($events);
}



public function getUpcomingDeadlines()
{
    $today = Carbon::today();
    $threshold = Carbon::today()->addDays(3); 

    $tasks = Task::where('user_id', auth()->id())
        ->whereNotNull('end_date')
        ->whereBetween('end_date', [$today, $threshold])
        ->whereIn('status', ['Belum Selesai', 'On Progress', 'Selesai'])
        ->get();

    return $tasks;
}


}

