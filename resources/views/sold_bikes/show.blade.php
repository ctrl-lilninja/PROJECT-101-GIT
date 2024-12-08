@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-semibold mb-4">Order Receipt</h1>

        <div class="border p-4 mb-6">
            <!-- Order Details -->
            <h2 class="text-xl font-semibold">Order ID: {{ $soldBike->sale->id }}</h2>
            <p><strong>Buyer:</strong> {{ $soldBike->sale->buyer_name }}</p>
            <p><strong>Contact:</strong> {{ $soldBike->sale->buyer_contact }}</p>
            <p><strong>Address:</strong> {{ $soldBike->sale->buyer_address }}</p>
            <p><strong>Total Amount:</strong> ${{ number_format($soldBike->sale->total_amount, 2) }}</p>
        </div>

        <div class="border p-4 mb-6">
            <!-- Bought Bikes -->
            <h2 class="text-xl font-semibold">Bought Bikes</h2>
            @foreach ($soldBike->sale->soldBikes as $sold)
                <p>{{ $sold->bike->name }} (Quantity: {{ $sold->quantity }}) - ${{ number_format($sold->bike->price, 2) }}</p>
            @endforeach
        </div>

        <!-- Print Button -->
        <div class="flex justify-end">
            <button onclick="window.print()" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                Print Receipt
            </button>
        </div>
    </div>
</div>
@endsection
