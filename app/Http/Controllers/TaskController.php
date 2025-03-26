<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\TaskSharedNotification;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    public function shareTask(Request $request, Task $task) {
        $request->validate([
            'users' => 'required|array',
            'users.*' => 'exists:users,id',
        ]);
    
        $task->sharedUsers()->sync($request->users);
    
        foreach ($request->users as $userId) {
            $user = User::find($userId);
            Mail::to($user->email)->send(new TaskSharedNotification($task));
        }
    
        return back()->with('success', 'Task shared successfully!');
    }
    
    
    //
}
