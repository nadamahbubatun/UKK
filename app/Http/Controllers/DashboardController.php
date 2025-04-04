<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Task;
use App\Models\ListTask; // Pastikan ini benar
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBoards = Board::count();
        $totalLists = ListTask::count(); // Gunakan TaskList, bukan ListTask
        $totalTasks = Task::count();

        return view('dashboard.home', compact('totalBoards', 'totalLists', 'totalTasks'));
    }
}
