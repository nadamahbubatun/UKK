<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListTask extends Model
{
    use HasFactory;

    protected $table = 'lists'; 
    protected $fillable = ['name', 'board_id'];

    public function board()
    {
        return $this->belongsTo(Board::class, 'board_id');
    }
    
    public function tasks()
    {
        return $this->hasMany(Task::class, 'list_id');
    }
    public function completedTasks()
{
    return $this->tasks()->where('status', 'selesai'); 
}

}
