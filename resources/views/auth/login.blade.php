@extends('layouts.guest')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gradient-to-br from-blue-500 to-indigo-600">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
        <!-- Logo or Welcome Icon -->
        <div class="flex justify-center">
            <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center text-white text-3xl font-bold shadow-md">
                🚴‍♂️
            </div>
        </div>

        <!-- Title and Subtitle -->
        <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-800">Welcome Back</h2>
        <p class="mt-2 text-sm text-center text-gray-600">
            Sign in to access your account
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mt-4 mb-4" :status="session('status')" />

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input id="email" name="email" type="email" autocomplete="username" required 
                       class="mt-2 block w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="Enter your email" value="{{ old('email') }}">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required 
                       class="mt-2 block w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="Enter your password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center text-sm text-gray-600">
                    <input id="remember_me" name="remember" type="checkbox" 
                           class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <span class="ml-2">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 rounded-lg text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 shadow-md">
                    Log in
                </button>
            </div>
        </form>

        <!-- Register Link -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-blue-500 hover:underline font-medium">
                    Register here
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
