<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Mail\TaskSharedNotification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;





class LogicController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        if ($request->has('tag') && $request->tag != '') {
            $query->where('tag', $request->tag);
        }
    
        $tasks = $query->get();
    
        $tasks = $query->where('user_id', Auth::id())->get();
    
        return view('tasks.index', compact('tasks'));
    }
    
public function Create_task()
{
  return view('tasks.create');
}
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'status' => 'required',
        'due_date' => 'required|date',
        'tag' => 'nullable|string'
    ]);

    Task::create([
        'user_id' => Auth::id(),
        'title' => $request->title,
        'description' => $request->description,
        'status' => $request->status,
        'due_date' => $request->due_date,
        'tag' => $request->tag
    ]);

    return redirect()->route('index')->with('success', 'Task created successfully!');
}

public function edit(Task $task, )
{

    if ($task->user_id !== auth()->id()) {
        return redirect()->route('tasks_index')->with('error', 'Unauthorized access.');
    }
    
    $users = User::all();
    return view('tasks.edit', compact('task','users')); 
}

public function update(Request $request, Task $task)
{
    if ($task->user_id !== auth()->id()) {
        return redirect()->route('index')->with('error', 'Unauthorized access.');
    }

    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:pending,in_progress,completed',
        'due_date' => 'nullable|date',
        'progress' => 'required|integer|min:0|max:100',
        'assigned_users' => 'array',
        'assigned_users.*' => 'exists:users,id',
    ]);

    $task->update([
        'title' => $request->title,
        'description' => $request->description,
        'status' => $request->status,
        'due_date' => $request->due_date,
        'progress' => $request->progress,
    ]);

    $task->users()->sync($request->assigned_users);


    return redirect()->route('index')->with('success', 'Task updated successfully!');
}


public function ShowProfile(){
    return view('edit_profile');
}
public function UpdateProfile(Request $request)
{

    $request->validate([
        'name' => 'required|string',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
    ]);

    $user = auth()->user();

    $file = $request->file('profile_picture');
    if ($file) {

        $imagePath = $file->store('profile_pictures', 'public');

        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }
        $user->profile_picture = $imagePath;
    }

    $user->name = $request->name;
    $user->save();
    return back()->with('success', 'Profile updated successfully!');
}

public function destroy($id)
{
    $task = Task::findOrFail($id);
    $task->delete();

    return redirect()->route('index')->with('success', 'Task deleted successfully.');
}

public function getDueTasks()
{
    $dueTasks = Task::dueSoon()->get();
    return response()->json($dueTasks);
}


public function showPasswordForm()
{
    return view('changepassword');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    $user = Auth::user();
   
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->route('index')->with('success', 'Password updated successfully.');
}

public function downloadTasksPDF(Request $request)
{
    $tasks = Task::where('user_id', Auth::id())->get();


    $pdf = PDF::loadView('tasks.pdf', compact('tasks'));


    return $pdf->download('tasks_list.pdf');
}


}
