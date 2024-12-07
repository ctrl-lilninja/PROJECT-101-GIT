@extends('layouts.app')

@section('content')
<form action="{{ route('sell.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="buyer_name" class="block text-sm font-medium text-gray-700">Buyer Name</label>
        <input type="text" id="buyer_name" name="buyer_name" class="mt-1 block w-full" required>
    </div>

    <div class="mb-4">
        <label for="contact" class="block text-sm font-medium text-gray-700">Contact</label>
        <input type="text" id="contact" name="contact" class="mt-1 block w-full" required>
    </div>

    <div class="mb-4">
        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
        <input type="text" id="address" name="address" class="mt-1 block w-full" required>
    </div>

    <div class="mb-4">
        <label for="barcode" class="block text-sm font-medium text-gray-700">Barcode</label>
        <input type="text" id="barcode" name="barcode" class="mt-1 block w-full" required>
    </div>

    <div class="mb-4">
        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
        <input type="number" id="quantity" name="quantity" class="mt-1 block w-full" required min="1">
    </div>

    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Sell Bike</button>
</form>
@endsection