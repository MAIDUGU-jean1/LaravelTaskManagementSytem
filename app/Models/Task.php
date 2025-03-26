<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';


    protected $fillable = ['user_id','title', 'description', 'status', 'due_date', 'tag', 'progress'];

    public function scopeDueSoon($query)
{
    return $query->where('due_date', '<=', now()->addDay())->where('status', '!=', 'Completed');
}

    public function user()
    {
        return $this->hasMany(Task::class);
    }
    public function sharedUsers() {
        return $this->belongsToMany(User::class, 'task_users');
    }

    public function users()
{
    return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id');
}

    
//
}
