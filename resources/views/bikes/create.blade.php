@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="font-semibold text-3xl text-gray-800 mb-6">Add New Bike</h2>

            <form action="{{ route('bikes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <!-- Barcode Field -->
                    <div class="mb-4">
                        <label for="barcode" class="block text-sm font-medium text-gray-700">Barcode</label>
                        <input type="text" name="barcode" id="barcode" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Scan or Enter Barcode" required>
                    </div>

                    <!-- Bike Name Field -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Bike Name</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <!-- Model Field -->
                    <div class="mb-4">
                        <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                        <input type="text" name="model" id="model" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <!-- Category Dropdown -->
                    <div class="mb-4">
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category_id" id="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Quantity Field -->
                    <div class="mb-4">
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <!-- Price Field -->
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                        <input type="number" name="price" id="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <!-- Photo Upload Field -->
                    <div class="mb-4">
                        <label for="photo" class="block text-sm font-medium text-gray-700">Bike Photo</label>
                        <input type="file" name="photo" id="photo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-4 text-center">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md text-sm">Add Bike</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('barcode').addEventListener('input', function(event) {
                const barcodeInput = event.target;
                const barcode = barcodeInput.value.trim();
                if (barcode.length >= 13) {  // Assuming barcode length is 13 digits
                    // Auto-submit the form once barcode is detected
                    document.querySelector('form').submit();
                }
            });
        </script>
    @endpush
@endsection
