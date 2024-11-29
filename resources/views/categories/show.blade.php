{{-- categories/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h2 class="font-semibold text-3xl text-gray-800 mb-6">{{ $category->name }} Bikes</h2>

        @if($bikes->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($bikes as $bike)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="relative">
                            <img src="{{ $bike->image_url }}" alt="{{ $bike->name }}" class="w-full h-48 object-cover">
                            <div class="absolute inset-0 bg-black opacity-50 flex items-center justify-center">
                                <h3 class="text-white text-xl font-semibold">{{ $bike->name }}</h3>
                            </div>
                        </div>

                        <div class="p-4">
                            <p class="text-gray-700 text-sm"><strong>Stock:</strong> {{ $bike->quantity }} pcs</p>
                            <p class="text-gray-700 text-sm"><strong>Price:</strong> ${{ number_format($bike->price, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No bikes available in this category.</p>
        @endif
    </div>
@endsection
