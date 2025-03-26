<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Task Management</title>
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(45deg, #1e3c72, #2a5298);
            color: #fff;
            padding: 0;
            overflow-x: hidden;
            /* background-image: url("{{ asset('img/background.jpeg') }}"); */
         
          
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgb(27, 27, 27);
            padding: 10px 20px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            animation: slideDown 1s ease-out;
        }


        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
            animation: fadeIn 2s ease-in;
        }


        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            background-color: #fff;
            bottom: -5px;
            left: 0;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }

        .nav-links a:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        .nav-links a:hover {
            color: #ff6347;
        }


        @keyframes slideDown {
            from {
                transform: translateY(-100%);
            }
            to {
                transform: translateY(0);
            }
        }


        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }


        .welcome-section {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            padding-top: 60px;
        }

        .welcome-section h1 {
            font-size: 50px;
            margin-bottom: 20px;
            animation: fadeInText 3s ease-in-out;
        }

        .welcome-section p {
            font-size: 20px;
            animation: fadeInText 3s ease-in-out;
            animation-delay: 1s;
        }


        @keyframes fadeInText {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }


        .cta-btn {
            padding: 10px 20px;
            background-color: #ff6347;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .cta-btn:hover {
            background-color: #e53e2b;
        }
    </style>
</head>
<body>

    <nav>
        <div class="logo">Task Manager</div>
        <div class="nav-links">
            <a href="#about">About</a>
            <a href="#features">Features</a>
            <a href="#contact">Contact</a>
            <a href="/register" class="btn btn-warning">SignUp</a>
            <a href="/login" class="btn btn-check">Login</a>
        </div>
    </nav>

    <section class="welcome-section">
        <h1>Welcome to the Task Management System</h1>
        <p>Manage your tasks effectively and stay organized!</p>
        <a href="{{ route('register') }}" class="cta-btn">Get Started</a>
    </section>


    <script>
        const navLinks = document.querySelectorAll('.nav-links a');

        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.querySelector(link.getAttribute('href'));
                window.scrollTo({
                    top: target.offsetTop,
                    behavior: 'smooth'
                });
            });
        });
    </script>

</body>
</html>
