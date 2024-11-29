@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-8">
        <!-- Add Category Button -->
        <div class="mb-6">
            <a href="{{ route('categories.create') }}" class="bg-green-500 text-white px-6 py-3 rounded-md inline-block">Add Category</a>
        </div>

        <h2 class="font-semibold text-3xl text-gray-800 mb-6">{{ __('Categories') }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories as $category)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/categories/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $category->name }}</h3>
                        <div class="mt-4 flex justify-between">
                        <a href="{{ route('bikes.index', ['category_id' => $category->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md inline-block">View Bikes</a>
                            @if(auth()->check() && auth()->user()->is_admin) <!-- Optional: only show delete for admin -->
                                <button class="text-red-500 hover:text-red-700 px-4 py-2" onclick="confirmDelete({{ $category->id }})">Delete</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden justify-center items-center">
        <div class="bg-white rounded-lg p-6 max-w-sm mx-auto">
            <h3 class="text-lg font-semibold text-gray-700">Are you sure you want to delete this category?</h3>
            <div class="mt-4 flex justify-between">
                <button id="cancelDelete" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md">Cancel</button>
                <form id="deleteForm" action="#" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // Show delete confirmation modal
        function confirmDelete(categoryId) {
            var deleteForm = document.getElementById('deleteForm');
            var deleteUrl = '/categories/' + categoryId;
            deleteForm.action = deleteUrl;

            var modal = document.getElementById('deleteModal');
            modal.classList.remove('hidden');

            // Close modal if cancel is clicked
            document.getElementById('cancelDelete').onclick = function () {
                modal.classList.add('hidden');
            }
        }
    </script>
@endsection
