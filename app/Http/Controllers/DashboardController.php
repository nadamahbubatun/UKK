<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Task;
use App\Models\ListTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Ambil user yang login

        $totalBoards = Board::where('user_id', $user->id)->count();

        $totalLists = ListTask::whereHas('board', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();

        $totalTasks = Task::whereHas('list', function ($query) use ($user) {
            $query->whereHas('board', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        })->count();

        return view('dashboard.home', compact('totalBoards', 'totalLists', 'totalTasks'));
    }
}
