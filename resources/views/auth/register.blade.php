
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
 <style> 
    
 </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg rounded-4" style="width: 100%; max-width: 400px;">
            <h2 class="text-center mb-4">Register</h2>
            <form method="POST" action="{{ route("register") }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter your full name" required value="{{ old('name') }}">
                </div>

           
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter your email" required value="{{ old('email') }}">
                </div>

               
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required >
                </div>

                
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation"id="confirm-password" placeholder="Confirm password" required>
                </div>

              
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>

               
                <p class="text-center mt-3">
                    Already have an account? <a href="{{ route("show_login") }}" class="text-primary">Login</a>
                </p>
                @if ($errors->any())
                <ul class="px-4 py-2 bg-red-100">
                    @foreach ($errors->all() as $error)
                    <li class="my-2 text-red-500"> {{ $error }}</li>
                        
                    @endforeach
                </ul>
                    
                @endif
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

