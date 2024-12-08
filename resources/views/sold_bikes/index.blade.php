@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-semibold mb-4">Sales Overview</h1>

        <!-- Example content for the sales page -->
        <p class="text-gray-700">Welcome to the Sales page. Here you can manage your sales.</p>

        <!-- Sales Table -->
        <table class="min-w-full divide-y divide-gray-200 mt-4">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sale ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buyer</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($soldBikes as $soldBike)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $soldBike->sale->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $soldBike->sale->buyer_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${{ $soldBike->sale->total_amount }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $soldBike->sale->created_at->format('Y-m-d') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('sold_bikes.show', $soldBike->id) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
