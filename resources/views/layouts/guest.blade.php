<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md px-6 py-6 bg-white shadow-lg rounded-lg bg-gray-800">
            
            <div class="flex justify-center">
                <img src="{{ asset('images/bike.png') }}" alt="Bikeru" style="width: 100px; height: auto;">
            </div>
            
            <!-- Header (app name or logo) -->
            <div class="mb-6 text-center">
                <h1 class="text-3xl font-semibold text-red-600">BIKERU</h1>
                <p class="text-sm text-gray-500 mt-2">Bike Inventory and Point of Sale with Barcode Integration</p>
            </div>

            <!-- The content slot (for login or registration form) -->
            {{ $slot }}

            <!-- Switch between login/register -->
            <div class="mt-4 text-center">
                @if(Route::is('login'))
                    <p class="text-sm text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="font-medium text-red-600 hover:text-red-900">
                            Register here
                        </a>
                    </p>
                @elseif(Route::is('register'))
                    <p class="text-sm text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-medium text-red-600 hover:text-red-900">
                            Login here
                        </a>
                    </p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
