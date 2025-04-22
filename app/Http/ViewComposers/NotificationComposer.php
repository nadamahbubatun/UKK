<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class NotificationComposer
{
    public function compose(View $view)
    {
        $user = Auth::user();

        $today = Carbon::today();
        $upcoming = Carbon::today()->addDays(3);

        $notifications = Task::where('user_id', $user->id ?? null)
            ->where('end_date', '>=', $today)
            ->where('end_date', '<=', $upcoming)
            ->where('status', '!=', 'Selesai')
            ->orderBy('end_date')
            ->get();

        $view->with('notifications', $notifications);
    }
}
