<x-layout>
    <html>
        <head>
            <title>Edit Task</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <div class="container mt-4">
                <h1>Edit Task</h1>

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <form action="{{ route('tasks.share', $task->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="assigned_users" class="form-label">Assign Users</label>
                        <select name="assigned_users[]" id="assigned_users" class="form-control" multiple>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" 
                                    @if($task->users && in_array($user->id, $task->users->pluck('id')->toArray())) selected @endif>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-2">Share Task</button>
                    
                    
                </form>
                
                <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Task Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $task->description ?? '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="progress" class="form-label">Progress (%)</label>
                        <input type="range" class="form-range" id="progress" name="progress" min="0" max="100" 
                            value="{{ $task->progress }}" oninput="progressValue.innerText = this.value + '%'">
                        <span id="progressValue">{{ $task->progress }}%</span>
                    </div>

                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $task->due_date }}">
                    </div>

                    <button type="submit" class="btn btn-success">Update Task</button>
                    <a href="{{ route('index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const progressInput = document.getElementById('progress');
                    const progressValue = document.getElementById('progressValue');

                    progressInput.addEventListener('input', function () {
                        progressValue.innerText = progressInput.value + '%';
                    });
                });
            </script>
        </body>
    </html>
</x-layout>
