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
            
            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <h3>Update Profile</h3>
            <form action="{{ route('profile.Update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="text-center mb-3">
                    <img src="{{ asset('storage/' . Auth::user()?->profile_picture) }}" class="profile-img" alt="Profile Picture">
                </div>
                <div class="mb-3">
                    <label>Username:</label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                </div>
                <div class="mb-3">
                    <label>Profile Picture:</label>
                    <input type="file" name="profile_picture" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Update Profile</button>
            @error('profile_picture')
                {{ $message }}
            @enderror
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



