<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Edit Profile</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('index') }}" class="btn btn-secondary">Back to Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="text-center mb-4">Edit Your Profile</h2>
            <div class="text-center mb-3">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="profile-img" alt="Profile Picture">
            </div>
            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif
            @error('current_password')
                <div class="alert alert-danger text-center">
                    {{ $message }}
                </div>
                
            @enderror

            <h3>Change Password</h3>
<form action="{{ route('password') }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Current Password:</label>
        <input type="password" name="current_password" class="form-control" required>
    </div>
    @error('current_password')
    <div class="alert alert-danger text-center">
        {{ $message }}
        
    @enderror
    <div class="mb-3">
        <label>New Password:</label>
        <input type="password" name="new_password" class="form-control" required>
          @error('new_password')
    <div class="alert alert-danger text-center">
        {{ $message }}
        
    @enderror
    </div>
  
    <div class="mb-3">
        <label>Confirm New Password:</label>
        <input type="password" name="new_password_confirmation" class="form-control" required>
    </div>
    @error('new_password_confirmation')
    <div class="alert alert-danger text-center">
        {{ $message }}
        
    @enderror
    <button type="submit" class="btn btn-warning">Change Password</button>
</form>
</div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




