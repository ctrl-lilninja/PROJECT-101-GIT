<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Category;
use Illuminate\Http\Request;

class BikeController extends Controller
{
    public function index(Request $request)
    {
        // Check if category_id is present in the query string
        if ($request->has('category_id')) {
            // Filter bikes by the selected category
            $bikes = Bike::where('category_id', $request->category_id)->get();
        } else {
            // Show all bikes if no category is specified
            $bikes = Bike::all();
        }

        // Pass bikes to the view
        return view('bikes.index', compact('bikes'));
    }

    public function create()
    {
        $categories = Category::all(); // Fetch all categories to use in a dropdown
        return view('bikes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        Bike::create($request->all()); // Insert bike

        return redirect()->route('bikes.index');
    }

    public function edit(Bike $bike)
    {
        $categories = Category::all(); // Fetch all categories for the dropdown
        return view('bikes.edit', compact('bike', 'categories'));
    }

    public function update(Request $request, Bike $bike)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $bike->update($request->all()); // Update bike

        return redirect()->route('bikes.index');
    }

    public function destroy(Bike $bike)
    {
        $bike->delete(); // Delete bike
        return redirect()->route('bikes.index');
    }
}
