<p>Hello,</p>
<p>A new task titled "<strong>{{ $task->title }}</strong>" has been shared with you.</p>
<p>Click <a href="{{ route('tasks.edit', $task->id) }}">here</a> to view the task.</p>
<p>Thanks!</p>
