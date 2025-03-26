<x-layout>
    <html>
        <head>
            <title>Task Management </title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .dark-mode{
    background-color: #333;
    color: #fff;
}
button{
    height: 40px ;
    border-radius: 5px
}
.dark-mode .theme-toggle-icon{
    color: #fff;
}
        </style>
        
        </head>

        <body>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this task?
            </div>
            <div class="modal-footer">
                <form id="deleteTaskForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>


            <div class="container mt-4">
                <h1 class="mb-4">Welcome To Dashboard</h1>
                <form action="{{ route('index') }}" method="GET" class="mb-3">
                    
                    <label for="statusFilter" class="form-label">Filter by Status:</label>
                    <select name="status" id="statusFilter" class="form-select" onchange="this.form.submit()">
                        <option value="">All Tasks</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    <label for="statusFilter" class="form-label">Filter by Status:</label>  
                    <select name="status" id="statusFilter" class="form-select" onchange="this.form.submit()">  
                        <option value="" disabled selected>Select a status</option>  
                        <option value="active">Active</option>  
                        <option value="inactive">Inactive</option>  
                        <option value="pending">Pending</option>  
                        <option value="suspended">Suspended</option>  
                    </select>  
                </form>
                <form method="GET" action="{{ route('index') }}" class="mb-3 d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search tasks..." value="{{ request('search') }}">
                    
                    <select name="tag" class="form-control me-2">
                        <option value="">Filter by Tag</option>
                        <option value="urgent" {{ request('tag') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                        <option value="work" {{ request('tag') == 'work' ? 'selected' : '' }}>Work</option>
                        <option value="home" {{ request('tag') == 'home' ? 'selected' : '' }}>Home</option>
                        <option value="personal" {{ request('tag') == 'personal' ? 'selected' : '' }}>Personal</option>
                    </select>
                
                    <button type="submit" class="btn btn-primary">Apply</button>
                </form>
                
                
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                    <div class="d-flex">
                        <a href="{{ route('create_task') }}" class="btn btn-primary mb-3">Create New Task</a>
<button id="theme-toggle" class="theme-toggle ms-auto">
    Toggle Mode 
    <span class="theme-toggle-icon">
        <i class="fas fa-sun"></i>
        <i class="fas fa-moon"></i>
    </span>
</button>
                    </div>


                <h2>Tasks List</h2>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>progress Bar</th>
                            <th>Status</th>
                            <th>Due Date</th>
                            <th>Actions</th>
                            <th>Tags</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $task->progress }}%;" 
                                         aria-valuenow="{{ $task->progress }}" aria-valuemin="0" aria-valuemax="100">
                                        {{ $task->progress }}%
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($task->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($task->status == 'in_progress')
                                    <span class="badge bg-info">In Progress</span>
                                @else
                                    <span class="badge bg-success">Completed</span>
                                @endif
                            </td>
                            <td>{{ $task->due_date }}</td>
                            <td>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-task-id="{{ $task->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                    {{-- <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        
                                    </button> --}}
                                </form>
                            </td>
                            <td>
                                @if($task->tag)
                                    <span class="badge 
                                        @if($task->tag == 'urgent') bg-danger 
                                        @elseif($task->tag == 'work') bg-primary 
                                        @elseif($task->tag == 'home') bg-success 
                                        @else bg-secondary 
                                        @endif">
                                        {{ ucfirst($task->tag) }}
                                    </span>
                                @endif
                            </td>
                            
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <a href="{{ route('tasks.downloadPDF') }}" class="btn btn-primary mb-3">Download Task List (PDF)</a>

            </div>
            <script>
const themeToggle = document.getElementById('theme-toggle')
themeToggle.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');

    localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
});

if(localStorage.getItem('darkMode') === 'true') {
    document.body.classList.add('dark-mode');
}
const deleteButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const taskId = this.getAttribute('data-task-id');
            const deleteForm = document.getElementById('deleteTaskForm');
            deleteForm.action = `/tasks/${taskId}`; 
        });
    });

            </script>
        </body>
    </html>
</x-layout>
