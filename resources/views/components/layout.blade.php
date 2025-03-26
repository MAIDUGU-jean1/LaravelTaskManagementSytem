<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .notification-bell {
            position: relative;
            cursor: pointer;
        }
        .notification-bell .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: red;
            color: white;
            font-size: 12px;
            border-radius: 50%;
            padding: 5px 8px;
        }
        .nav-item p {
    font-size: 18px; /* Adjust the font size */
    padding-left: 10px; /* Adds some padding to the left */
    padding-right: 10px; /* Adds some padding to the right */
    border-radius: 5px; /* Rounded corners */
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
}

    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">Tasks Management</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <p class="m-0 text-white fw-bold" style="font-size: 18px; padding: 5px 10px; background-color: rgba(0, 0, 0, 0.6); border-radius: 5px;">Welcome <span class="text-uppercase">{{ Auth::user()?->name }}</span></p>
                    </li>
                    
                    
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('index') ? 'active' : '' }}" href="{{ route('index') }}">My Tasks</a>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('tasks/create') ? 'active' : '' }}" href="{{ route('create_task') }}">Create New Task</a>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link notification-bell" href="#" id="notificationBell" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-bell"></i>
                            <span id="taskCount" class="badge d-none">0</span>
                        </a>
                        <ul id="taskList" class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item text-muted">No pending tasks</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <img src="{{ asset('storage/' . Auth::user()?->profile_picture) }}" alt="Profile" class="profile-img me-2">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('showPasswordForm') }}">Change Password</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
      {{ $slot }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function fetchDueTasks() {
            fetch('/tasks/due')
                .then(response => response.json())
                .then(data => {
                    let taskList = document.getElementById('taskList');
                    let taskCount = document.getElementById('taskCount');

                    taskList.innerHTML = "";
                    if (data.length > 0) {
                        taskCount.classList.remove('d-none');
                        taskCount.innerText = data.length;

                        data.forEach(task => {
                            taskList.innerHTML += `<li><a class="dropdown-item">${task.title} - Due: ${new Date(task.due_date).toLocaleDateString()}</a></li>`;
                        });
                    } else {
                        taskCount.classList.add('d-none');
                        taskList.innerHTML = `<li><a class="dropdown-item text-muted">No pending tasks</a></li>`;
                    }
                })
                .catch(error => console.error('Error fetching tasks:', error));
        }

        setInterval(fetchDueTasks, 60000); 
        fetchDueTasks();
    </script>

</body>
</html>
