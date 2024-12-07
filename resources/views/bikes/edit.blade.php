@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h2 class="font-semibold text-3xl text-gray-800 mb-6">Edit Bike</h2>

        <form action="{{ route('bikes.update', $bike->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Bike Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $bike->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                <input type="text" name="model" id="model" value="{{ old('model', $bike->model) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == old('category_id', $bike->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $bike->quantity) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" id="price" value="{{ old('price', $bike->price) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="barcode" class="block text-sm font-medium text-gray-700">Barcode</label>
                <input type="text" name="barcode" id="barcode" value="{{ old('barcode', $bike->barcode) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                <input type="file" name="photo" id="photo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @if ($bike->photo)
                    <img src="{{ asset('storage/' . $bike->photo) }}" alt="Current Photo" class="mt-2 w-32 h-32 object-cover">
                @endif
            </div>

            <div class="mb-4 text-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md text-sm">Update Bike</button>
            </div>
        </form>
    </div>
@endsection
