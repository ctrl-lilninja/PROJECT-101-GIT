@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h2 class="font-semibold text-3xl text-gray-800 mb-6">{{ __('Add Category') }}</h2>

        <div class="bg-white shadow-xl rounded-lg p-8">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Category Name</label>
                    <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-gray-700">Category Image</label>
                    <input type="file" name="image" id="image" class="w-full px-4 py-2 border rounded-md">
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Save Category</button>
            </form>
        </div>
    </div>
@endsection
