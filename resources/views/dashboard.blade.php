@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h2 class="font-semibold text-3xl text-gray-800 mb-6">{{ __('Dashboard') }}</h2>

        <div class="bg-white shadow-xl rounded-lg p-8">
            <div class="text-gray-900 text-lg">
                {{ __("You're logged in!") }}
            </div>
        </div>

        <div class="mt-8 space-y-6">
            <!-- Stats or Other Information -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-blue-600 text-white p-6 rounded-lg shadow-lg text-center">
                    <h3 class="text-xl font-semibold">{{ __('Total Bikes') }}</h3>
                    <p class="text-3xl">{{ $totalBikes ?? 10 }}</p> <!-- Replace with dynamic count -->
                </div>
                <div class="bg-green-600 text-white p-6 rounded-lg shadow-lg text-center">
                    <h3 class="text-xl font-semibold">{{ __('Available Bikes') }}</h3>
                    <p class="text-3xl">{{ $availableBikes ?? 7 }}</p> <!-- Replace with dynamic count -->
                </div>
                <div class="bg-yellow-600 text-white p-6 rounded-lg shadow-lg text-center">
                    <h3 class="text-xl font-semibold">{{ __('Sold Bikes') }}</h3>
                    <p class="text-3xl">{{ $soldBikes ?? 3 }}</p> <!-- Replace with dynamic count -->
                </div>
            </div>

            <!-- Categories Section -->
            <div class="bg-white shadow-xl rounded-lg p-8 mt-6">
                <h3 class="text-2xl font-semibold mb-4">{{ __('Bike Categories') }}</h3>

                @if($categories->isNotEmpty())
                    <ul class="space-y-4">
                        @foreach($categories as $category)
                            <li class="flex items-center justify-between">
                                <span class="text-lg font-medium">{{ $category->name }}</span>
                                <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-500 hover:underline">
                                    {{ __('Edit') }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>{{ __('No categories found.') }}</p>
                @endif
            </div>
        </div>
    </div>
@endsection
