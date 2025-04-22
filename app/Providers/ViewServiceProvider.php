<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Task;
use Carbon\Carbon;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $user = auth()->user();
            $notifications = [];

            if ($user) {
                $tasks = Task::where('user_id', $user->id)->get();

                foreach ($tasks as $task) {
                    if ($task->status === 'Selesai') {
                        $notifications[] = "🎉 Task <strong>{$task->name}</strong> telah selesai.";
                    }

                    if ($task->end_date) {
                        $end = Carbon::parse($task->end_date);

                        if ($end->isToday()) {
                            $notifications[] = "⏰ Task <strong>{$task->name}</strong> berakhir hari ini!";
                        } elseif ($end->diffInDays(Carbon::now()) === 1 && $end->greaterThan(Carbon::now())) {
                            $notifications[] = "⚠️ Task <strong>{$task->name}</strong> akan berakhir besok!";
                        }
                    }
                }
            }

            $view->with('globalNotifications', $notifications);
        });
    }
}
