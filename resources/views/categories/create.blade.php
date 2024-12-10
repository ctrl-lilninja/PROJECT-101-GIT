@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-8">
        <h2 class="font-semibold text-3xl text-gray-800 mb-6 text-center">{{ __('Add Category') }}</h2>

        <div class="bg-white shadow-2xl rounded-2xl p-8">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label for="name" class="block text-gray-700 text-sm font-medium">Category Name</label>
                    <input type="text" name="name" id="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                </div>

                <div class="mb-6">
                    <label for="image" class="block text-gray-700 text-sm font-medium">Category Image</label>
                    <input type="file" name="image" id="image" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                    <div id="imagePreview" class="mt-4 hidden">
                        <p class="text-gray-700">Image Preview:</p>
                        <img id="preview" src="" alt="Image Preview" class="w-32 h-32 object-cover rounded-lg mt-2">
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-red-600 text-white font-semibold text-lg px-6 py-3 rounded-lg shadow-md hover:bg-red-700 focus:ring-2 focus:ring-red-500 transition duration-300 w-full sm:w-auto">
                        Add Category
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // Image preview functionality
        document.getElementById('image').addEventListener('change', function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('hidden');
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
