    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Form</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
    
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="card p-4 shadow-lg rounded-4" style="width: 100%; max-width: 400px;">
                <h2 class="text-center mb-4">Login</h2>
                <form method="POST" action="{{ route("login") }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" value="{{  old ('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember-me">
                            <label class="form-check-label" for="remember-me">Remember me</label>
                        </div>
                        <a href="#" class="text-primary">Forgot password?</a>
                    </div>
    

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
    
                    <p class="text-center mt-3">
                        Don't have an account? <a href="{{ route("show_register") }}" class="text-primary">Register</a>
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
    
    