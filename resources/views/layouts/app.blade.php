<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Bike Inventory') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* General Styles */
        body {
            background-color: #f7fafc;
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #2d3748;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Navbar Styles - Sticky Navbar */
        nav {
            background-color: #4c51bf;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
            width: 100%;
            padding: 0.75rem 2rem;
            transition: background-color 0.3s;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 1.25rem;
        }

        nav a:hover {
            color: #cbd5e0;
        }

        nav .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Hamburger Icon */
        .hamburger {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 25px;
            cursor: pointer;
        }

        .hamburger div {
            height: 5px;
            background-color: white;
            border-radius: 5px;
        }

        /* Menu Dropdown for Mobile */
        .menu {
            display: flex;
            gap: 1rem;
        }

        .menu a {
            color: white;
            font-size: 1.1rem;
            text-decoration: none;
            padding: 10px;
        }

        .menu a:hover {
            background-color: #edf2f7;
            color: #4c51bf;
            border-radius: 5px;
        }

        .dropdown-menu {
            display: none;
            flex-direction: column;
            gap: 1rem;
            position: absolute;
            background-color: #4c51bf;
            top: 50px;
            right: 20px;
            border-radius: 8px;
            padding: 10px;
            z-index: 100;
        }

        .dropdown-menu a {
            color: white;
            font-size: 1.1rem;
            padding: 10px;
            text-decoration: none;
        }

        .dropdown-menu a:hover {
            background-color: #edf2f7;
            color: #4c51bf;
            border-radius: 5px;
        }

        /* Mobile Styles */
        @media screen and (max-width: 768px) {
            .menu {
                display: none;
            }

            .hamburger {
                display: flex;
            }

            .dropdown-menu {
                top: 40px;
                left: 20px;
            }
        }

        /* Footer Styles */
        footer {
            background-color: #4c51bf;
            color: white;
            text-align: center;
            font-size: 0.875rem;
            padding: 1rem 0;
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
            z-index: 50;
        }

        footer p {
            margin: 0;
        }

        /* Content Section */
        main {
            flex: 1;
            padding: 2rem 0;
            padding-bottom: 5rem;
        }

        /* Footer Visibility on Scroll */
        footer.hidden {
            display: none;
        }

        /* Ensure Logout button is styled */
        form button {
            background-color: transparent;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        form button:hover {
            background-color: #edf2f7;
            color: #4c51bf;
            border-radius: 5px;
        }

        /* Category Card Styles */
        .bg-white {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .bg-blue-500 {
            background-color: #4299e1;
        }

        .bg-red-500 {
            background-color: #f56565;
        }

        .text-white {
            color: white;
        }

        .text-gray-700 {
            color: #4a5568;
        }

        .text-gray-800 {
            color: #2d3748;
        }

        .text-gray-500 {
            color: #a0aec0;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        .text-xl {
            font-size: 1.25rem;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .rounded-md {
            border-radius: 0.375rem;
        }

        .inline-block {
            display: inline-block;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        /* Modal Styles */
        #deleteModal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
        }

        .bg-white {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav>
        <div class="container">
            <a href="{{ route('dashboard') }}" class="text-2xl font-semibold">
                🚴‍♂️ Bike Inventory
            </a>

            <div class="hamburger" id="hamburger" onclick="toggleMenu()">
                <div></div>
                <div></div>
                <div></div>
            </div>

            <div class="menu" id="menu">
                <a href="{{ route('bikes.index') }}">Bikes</a>
                <a href="{{ route('categories.index') }}">Categories</a> <!-- Only link to categories page -->
                <a href="{{ route('profile.edit') }}">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="dropdown-menu" id="dropdown-menu">
            <a href="{{ route('bikes.index') }}">Bikes</a>
            <a href="{{ route('categories.index') }}">Categories</a>  <!-- Only link to categories page -->
            <a href="{{ route('profile.edit') }}">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <div class="bg-white p-6">
            @yield('content')
        </div>
    </main>

    <footer id="footer">
        <p>&copy; {{ date('Y') }} Bike Inventory. All rights reserved.</p>
    </footer>

    <script>
        function toggleMenu() {
            const dropdownMenu = document.getElementById('dropdown-menu');
            const menu = document.getElementById('menu');

            if (dropdownMenu.style.display === "none" || dropdownMenu.style.display === "") {
                dropdownMenu.style.display = "flex";
                menu.style.display = "none";
            } else {
                dropdownMenu.style.display = "none";
                menu.style.display = "flex";
            }
        }

        window.addEventListener('scroll', function() {
            const footer = document.getElementById('footer');
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
                footer.classList.remove('hidden');
            } else {
                footer.classList.add('hidden');
            }
        });
    </script>

</body>
</html>
