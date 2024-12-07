@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold">Sold Bikes</h1>

        <table class="mt-4 w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">Buyer</th>
                    <th class="px-4 py-2 text-left">Bike</th>
                    <th class="px-4 py-2 text-left">Quantity</th>
                    <th class="px-4 py-2 text-left">Total Amount</th>
                    <th class="px-4 py-2 text-left">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($soldBikes as $soldBike)
                    <tr>
                        <td class="px-4 py-2">{{ $soldBike->sale->buyer_name }}</td>
                        <td class="px-4 py-2">{{ $soldBike->bike->name }}</td>
                        <td class="px-4 py-2">{{ $soldBike->quantity }}</td>
                        <td class="px-4 py-2">${{ $soldBike->quantity * $soldBike->bike->price }}</td>
                        <td class="px-4 py-2">{{ $soldBike->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
