@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h2 class="font-semibold text-3xl text-gray-900 mb-6">Bike Inventory</h2>

        <div class="mb-6">
            <a href="{{ route('bikes.create') }}" class="bg-red-600 text-white px-6 py-3 rounded-md shadow-lg hover:bg-red-700 transition duration-200">Add New Bike</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($bikes as $bike)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 hover:shadow-2xl transition duration-300">
                    <div class="relative">
                        <img src="{{ $bike->photo ? asset('storage/' . $bike->photo) : 'default-image.jpg' }}" alt="{{ $bike->name }}" class="w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-black opacity-50 flex items-center justify-center">
                            <h3 class="text-white text-xl font-bold">{{ $bike->name }}</h3>
                        </div>
                    </div>

                    <div class="p-6">
                        <p class="text-gray-700 text-sm"><strong>Category:</strong> 
                            {{ $bike->category ? $bike->category->name : 'No Category' }}
                        </p>
                        <p class="text-gray-700 text-sm"><strong>Stock:</strong> {{ $bike->quantity }} pcs</p>
                        <p class="text-gray-700 text-sm"><strong>Price:</strong> ₱{{ number_format($bike->price, 2) }}</p>
                    </div>

                    <div class="p-4 bg-gray-100 text-center">
                        <a href="{{ route('bikes.edit', $bike->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-600 transition duration-150">Edit</a>

                        <form action="{{ route('bikes.destroy', $bike->id) }}" method="POST" class="inline-block ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md text-sm hover:bg-red-600 transition duration-150">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* Custom CSS for Bike Inventory Cards */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .card-image {
            position: relative;
        }

        .card-image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-header {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-header h3 {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .card-body {
            padding: 1rem;
            text-align: left;
        }

        .card-footer {
            background: #f9fafb;
            padding: 1rem;
            text-align: center;
        }

        .card-footer button {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
    </style>
@endsection
