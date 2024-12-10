@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-8">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-3xl mx-auto">
            <h2 class="font-semibold text-3xl text-gray-800 mb-6 text-center">Edit Bike</h2>

            <form action="{{ route('bikes.update', $bike->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-6">

                    <!-- Bike Name Field -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700">Bike Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $bike->name) }}" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3" required>
                    </div>

                    <!-- Model Field -->
                    <div class="mb-6">
                        <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                        <input type="text" name="model" id="model" value="{{ old('model', $bike->model) }}" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3" required>
                    </div>

                    <!-- Category Dropdown -->
                    <div class="mb-6">
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category_id" id="category" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == old('category_id', $bike->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Quantity Field -->
                    <div class="mb-6">
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $bike->quantity) }}" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3" required>
                    </div>

                    <!-- Price Field -->
                    <div class="mb-6">
                        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $bike->price) }}" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3" required>
                    </div>

                    <!-- Barcode Field -->
                    <div class="mb-6">
                        <label for="barcode" class="block text-sm font-medium text-gray-700">Barcode</label>
                        <input type="text" name="barcode" id="barcode" value="{{ old('barcode', $bike->barcode) }}" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3" required>
                    </div>

                    <!-- Photo Upload Field -->
                    <div class="mb-6">
                        <label for="photo" class="block text-sm font-medium text-gray-700">Bike Photo</label>
                        <input type="file" name="photo" id="photo" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3">
                        @if ($bike->photo)
                            <div class="mt-4">
                                <label class="text-sm text-gray-600">Current Photo</label>
                                <img src="{{ asset('storage/' . $bike->photo) }}" alt="Current Photo" class="mt-2 w-32 h-32 object-cover rounded-lg">
                            </div>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-6 text-center">
                        <button type="submit" class="bg-red-600 text-white font-semibold text-lg px-6 py-3 rounded-lg shadow-md hover:bg-red-700 focus:ring-2 focus:ring-red-500 transition duration-300">
                            Update Bike
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
