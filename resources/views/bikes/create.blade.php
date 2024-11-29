@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h2 class="font-semibold text-3xl text-gray-800 mb-6">Add New Bike</h2>

        <form action="{{ route('bikes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Bike Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                <input type="text" name="model" id="model" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" id="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="barcode" class="block text-sm font-medium text-gray-700">Barcode</label>
                <input type="text" name="barcode" id="barcode" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="mb-4 text-center">
                <button type="button" id="generate-barcode" class="bg-green-500 text-white px-4 py-2 rounded-md text-sm">Generate Barcode</button>
            </div>

            <div class="mb-4 text-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md text-sm">Add Bike</button>
            </div>
        </form>
    </div>

    @section('scripts')
    <script>
        // You can use a library for barcode generation (e.g., JsBarcode)
        document.getElementById('generate-barcode').addEventListener('click', function () {
            var barcodeValue = document.getElementById('barcode').value;

            // Use JsBarcode or other barcode libraries for generation
            if (barcodeValue) {
                JsBarcode("#barcode", barcodeValue, {
                    format: "CODE128",
                    displayValue: true
                });
            } else {
                alert('Please enter a value for the barcode!');
            }
        });
    </script>
    @endsection
@endsection
