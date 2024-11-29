<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bike Inventory</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #f5f5f5, #e6f4ea, #d1e7f0);
            color: #333;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            border-top: 4px solid #4CAF50; /* Green border for inventory focus */
        }

        .card-header {
            font-size: 1.8rem;
            font-weight: 600;
            color: #1976D2; /* Blue for professionalism */
            margin-bottom: 10px;
        }

        .card-subtitle {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            font-size: 0.9rem;
            font-weight: 500;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4CAF50;
        }

        .form-footer {
            margin-top: 20px;
        }

        .btn {
            background: #1976D2;
            color: #fff;
            padding: 10px 15px;
            font-size: 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #155a9c;
        }

        .alt-link {
            margin-top: 15px;
            font-size: 0.9rem;
            color: #4CAF50;
            text-decoration: none;
        }

        .alt-link:hover {
            text-decoration: underline;
        }

        .form-toggle {
            margin-top: 10px;
            font-size: 0.9rem;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <!-- Login Form -->
            <div id="login-form">
                <div class="card-header">Bike Inventory Login</div>
                <div class="card-subtitle">Access your inventory account below</div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input id="email" name="email" type="email" placeholder="Enter your email" required autofocus>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" placeholder="Enter your password" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-footer">
                        <button type="submit" class="btn">Log In</button>
                    </div>
                </form>

                <!-- Register Link -->
                <div class="form-toggle">
                    <a href="#register-form" class="alt-link" onclick="toggleForm()">Don't have an account? Register here</a>
                </div>
            </div>

            <!-- Register Form (Initially Hidden) -->
            <div id="register-form" style="display: none;">
                <div class="card-header">Bike Inventory Registration</div>
                <div class="card-subtitle">Create a new account for your inventory</div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input id="name" name="name" type="text" placeholder="Enter your full name" required>
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input id="email" name="email" type="email" placeholder="Enter your email" required>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" placeholder="Enter your password" required>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm your password" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-footer">
                        <button type="submit" class="btn">Register</button>
                    </div>
                </form>

                <!-- Login Link -->
                <div class="form-toggle">
                    <a href="#login-form" class="alt-link" onclick="toggleForm()">Already have an account? Log in here</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to toggle between login and register forms
        function toggleForm() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            if (loginForm.style.display === 'none') {
                loginForm.style.display = 'block';
                registerForm.style.display = 'none';
            } else {
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
            }
        }
    </script>
</body>
</html>
