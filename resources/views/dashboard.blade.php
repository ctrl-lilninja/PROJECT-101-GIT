@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <!-- Dashboard Header -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-600">Overview of bikes and sales statistics</p>
    </div>

    <!-- Sales Overview Card -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Sales Overview</h3>
        
        <!-- Date Range Filter Form -->
        <form method="GET" action="{{ route('dashboard') }}" class="flex justify-center space-x-4 mb-6">
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="px-4 py-2 border rounded">
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="px-4 py-2 border rounded">
            <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded">Filter</button>
        </form>

        <!-- Sales Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Sales Today -->
            <div class="bg-green-100 p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold text-green-800">Sales Today</h3>
                <p class="mt-4 text-2xl font-bold text-gray-700">₱{{ number_format($salesToday, 2) }}</p>
            </div>

            <!-- Sales This Week -->
            <div class="bg-yellow-100 p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold text-yellow-800">Sales This Week</h3>
                <p class="mt-4 text-2xl font-bold text-gray-700">₱{{ number_format($salesWeek, 2) }}</p>
            </div>

            <!-- Sales This Month -->
            <div class="bg-purple-100 p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold text-purple-800">Sales This Month</h3>
                <p class="mt-4 text-2xl font-bold text-gray-700">₱{{ number_format($salesMonth, 2) }}</p>
            </div>

            <!-- Sales This Year -->
            <div class="bg-pink-100 p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold text-pink-800">Sales This Year</h3>
                <p class="mt-4 text-2xl font-bold text-gray-700">₱{{ number_format($salesYear, 2) }}</p>
            </div>
        </div>

        <!-- Sales in Selected Date Range -->
        <div class="mt-12 text-center">
            <h3 class="text-xl font-semibold text-gray-800">Sales in Selected Date Range</h3>
            <p class="mt-4 text-2xl font-bold text-gray-700">₱{{ number_format($salesInRange, 2) }}</p>
        </div>
    </div>

    <!-- Bikes Overview Section -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Bikes Overview</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Bikes Available -->
            <div class="bg-blue-100 p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold text-blue-800">Bikes Available</h3>
                <p class="mt-4 text-2xl font-bold text-gray-700">{{ $availableBikes->count() }}</p>
            </div>

            <!-- Bikes Sold -->
            <div class="bg-teal-100 p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold text-teal-800">Bikes Sold</h3>
                <p class="mt-4 text-2xl font-bold text-gray-700">{{ $totalBikesSold }}</p>
            </div>

            <!-- Bikes Sold by Type -->
            <div class="bg-indigo-100 p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold text-indigo-800">Bikes Sold (Type)</h3>
                <ul class="mt-4 text-gray-700">
                    @foreach ($soldBikesByType as $type => $count)
                        <li class="text-lg">{{ $type }}: <span class="font-bold">{{ $count }}</span></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Available Bikes Table -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Available Bikes</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                        <th class="py-3 px-6">Name</th>
                        <th class="py-3 px-6">Model</th>
                        <th class="py-3 px-6">Quantity</th>
                        <th class="py-3 px-6">Price</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @foreach ($availableBikes as $bike)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6">{{ $bike->name }}</td>
                            <td class="py-3 px-6">{{ $bike->model }}</td>
                            <td class="py-3 px-6">{{ $bike->quantity }}</td>
                            <td class="py-3 px-6">₱{{ number_format($bike->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
