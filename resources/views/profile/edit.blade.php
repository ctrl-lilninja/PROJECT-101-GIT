@extends('layouts.app')

@section('content')
    <style>
        /* Card Hover Effects */
        .card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 24px;
            transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        .card:hover {
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
            transform: translateY(-4px);
        }

        /* Input Fields Focus Effects */
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 5px rgba(79, 70, 229, 0.5);
        }

        /* Button Hover Effects */
        button {
            transition: transform 0.2s ease;
        }

        button:hover {
            transform: translateY(-2px);
        }

        /* Update Profile Button (Specific) */
        button.bg-blue-600:hover {
            background-color: #3b82f6;
        }

        /* Update Password Button (Specific) */
        button.bg-blue-600:hover {
            background-color: #3b82f6;
        }

        /* Delete Account Button (Specific) */
        button.bg-red-600:hover {
            background-color: #ef4444;
        }

        /* Container Spacing */
        .container-spacing {
            margin-top: 40px;
        }

        /* Heading Styling */
        h2, h3 {
            font-weight: 600;
            color: #2d3748;
        }

        /* Form Fields */
        label {
            font-weight: 500;
            font-size: 14px;
            color: #4a5568;
        }

        /* Success and Error Message Styling */
        .success-message {
            background-color: #10b981;
            color: white;
            padding: 12px;
            border-radius: 6px;
            margin-top: 10px;
        }

        .error-message {
            background-color: #f87171;
            color: white;
            padding: 12px;
            border-radius: 6px;
            margin-top: 10px;
        }

        /* Card Borders */
        .card {
            border: 1px solid #e5e7eb;
        }
    </style>

    <div class="max-w-4xl mx-auto">
        <h2 class="font-semibold text-3xl text-gray-800 mb-6">{{ __('Profile') }}</h2>

        <div class="space-y-8">
            <!-- Update Profile Information Card -->
            <div class="bg-white shadow-xl rounded-lg p-8 border border-gray-200 card">
                <h3 class="font-semibold text-2xl text-gray-800 mb-6">{{ __('Update Profile Information') }}</h3>
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <!-- Email -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            {{ __('Save Changes') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Update Password Card -->
            <div class="bg-white shadow-xl rounded-lg p-8 border border-gray-200 card">
                <h3 class="font-semibold text-2xl text-gray-800 mb-6">{{ __('Update Password') }}</h3>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <!-- Current Password -->
                    <div class="mb-6">
                        <label for="current_password" class="block text-sm font-medium text-gray-700">{{ __('Current Password') }}</label>
                        <input type="password" name="current_password" id="current_password" required
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <!-- New Password -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700">{{ __('New Password') }}</label>
                        <input type="password" name="password" id="password" required
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <!-- Confirm New Password -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('Confirm New Password') }}</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            {{ __('Update Password') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Delete Account Card -->
            <div class="bg-white shadow-xl rounded-lg p-8 border border-gray-200 card">
                <h3 class="font-semibold text-2xl text-gray-800 mb-6">{{ __('Delete Account') }}</h3>
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <!-- Password Confirmation -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Enter your password to confirm') }}</label>
                        <input type="password" name="password" id="password" required
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-md hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500">
                            {{ __('Delete Account') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
