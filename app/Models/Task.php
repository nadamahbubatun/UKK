<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['list_id','name', 'list_id', 'status', 'priority', 'start_date', 'end_date', 'description', 'user_id'];

    public function list()
    {
        return $this->belongsTo(ListTask::class, 'list_id');
    }
    
}
