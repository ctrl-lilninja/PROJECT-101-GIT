@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white p-8 rounded-lg shadow-xl max-w-3xl mx-auto space-y-8">
            <h2 class="font-semibold text-3xl text-gray-900 mb-6 text-center">Add New Bike</h2>

            <form action="{{ route('bikes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="space-y-6">
                    <!-- Barcode Field -->
                    <div>
                        <label for="barcode" class="block text-sm font-medium text-gray-700">Barcode</label>
                        <input type="text" name="barcode" id="barcode" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4 bg-gray-50" placeholder="Scan or Enter Barcode" required>
                    </div>

                    <!-- Bike Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Bike Name</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4 bg-gray-50" required>
                    </div>

                    <!-- Model Field -->
                    <div>
                        <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                        <input type="text" name="model" id="model" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4 bg-gray-50" required>
                    </div>

                    <!-- Category Dropdown -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category_id" id="category" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4 bg-gray-50" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Quantity Field -->
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4 bg-gray-50" required>
                    </div>

                    <!-- Price Field -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                        <input type="number" name="price" id="price" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4 bg-gray-50" required>
                    </div>

                    <!-- Photo Upload Field -->
                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700">Bike Photo</label>
                        <input type="file" name="photo" id="photo" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4 bg-gray-50">
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="bg-red-600 text-white font-semibold text-lg px-6 py-3 rounded-lg shadow-md hover:bg-red-700 focus:ring-2 focus:ring-red-500 transition duration-300 w-full sm:w-auto">
                            Add Bike
                        </button>
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
