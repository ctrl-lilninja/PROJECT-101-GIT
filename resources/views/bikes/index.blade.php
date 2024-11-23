@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Bike Inventory</h1>

    <a href="{{ route('bikes.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Add New Bike</a>

    <table class="w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">#</th>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Model</th>
                <th class="border border-gray-300 px-4 py-2">Category</th>
                <th class="border border-gray-300 px-4 py-2">Quantity</th>
                <th class="border border-gray-300 px-4 py-2">Price</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bikes as $bike)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $bike->id }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $bike->name }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $bike->model }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $bike->category->name ?? 'N/A' }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $bike->quantity }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $bike->price }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    <a href="{{ route('bikes.edit', $bike) }}" class="text-blue-500">Edit</a> |
                    <form action="{{ route('bikes.destroy', $bike) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
