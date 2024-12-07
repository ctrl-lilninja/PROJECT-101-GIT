@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bike Sales</h1>

    <!-- Barcode Search Form -->
    <div class="my-4">
        <form action="{{ route('sell.index') }}" method="GET">
            <input type="text" id="barcodeInput" name="barcode" class="p-2 border rounded w-full" placeholder="Scan or Enter Barcode">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded mt-2">Search Bike</button>
        </form>
    </div>

    <!-- Display Found Bike (if any) -->
    @if (isset($foundBike))
        <div class="mt-4">
            <p><strong>Bike Found:</strong> {{ $foundBike->name }} - Price: ${{ $foundBike->price }} - Available: {{ $foundBike->quantity }}</p>
        </div>
    @endif

    <!-- Sale Form -->
    <form action="{{ route('sell.store') }}" method="POST">
        @csrf

        <div>
            <label for="buyer_name">Buyer Name</label>
            <input type="text" id="buyer_name" name="buyer_name" class="p-2 border rounded w-full" required>
        </div>

        <div>
            <label for="contact">Contact</label>
            <input type="text" id="contact" name="contact" class="p-2 border rounded w-full" required>
        </div>

        <div>
            <label for="address">Address</label>
            <input type="text" id="address" name="address" class="p-2 border rounded w-full" required>
        </div>

        <!-- Bike Selection Dropdown -->
        <div>
            <label for="bike_name">Bike Name</label>
            <select id="bike_name" name="bike_id" class="p-2 border rounded w-full" required>
                <option value="">Select Bike</option>
                @foreach($bikes as $bike)
                    <option value="{{ $bike->id }}" data-quantity="{{ $bike->quantity }}" {{ isset($foundBike) && $foundBike->id == $bike->id ? 'selected' : '' }}>
                        {{ $bike->name }} - {{ $bike->quantity }} in stock
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" value="1" min="1" class="p-2 border rounded w-full" required>
        </div>

        <div>
            <label for="total_amount">Total Amount</label>
            <input type="number" id="total_amount" name="total_amount" class="p-2 border rounded w-full" readonly>
        </div>

        <button type="submit" class="bg-green-500 text-white p-2 rounded mt-4">Submit Sale</button>
    </form>

    <!-- Sales List -->
    <div class="mt-6">
        <h3>Recent Sales</h3>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th>Buyer</th>
                    <th>Bike</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
    @foreach ($sales as $sale)
        @foreach ($sale->soldBikes as $soldBike)
            <tr>
                <td>{{ $sale->buyer_name }}</td>
                <td>
                    @if ($soldBike->bike)
                        {{ $soldBike->bike->name }}
                    @else
                        <span class="text-red-500">Bike Not Found</span>
                    @endif
                </td>
                <td>{{ $soldBike->quantity }}</td>
                <td>${{ $sale->total_amount }}</td>
                <td>{{ $sale->created_at->format('Y-m-d') }}</td>
            </tr>
        @endforeach
    @endforeach
</tbody>

        </table>
    </div>
</div>
@endsection
