<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Category;
use Illuminate\Http\Request;

class BikeController extends Controller
{
    public function index()
    {
        $bikes = Bike::with('category')->get();
        return view('bikes.index', compact('bikes'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('bikes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'model' => 'required',
            'category_id' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        Bike::create($request->all());
        return redirect()->route('bikes.index')->with('success', 'Bike added successfully.');
    }

    public function edit(Bike $bike)
    {
        $categories = Category::all();
        return view('bikes.edit', compact('bike', 'categories'));
    }

    public function update(Request $request, Bike $bike)
    {
        $request->validate([
            'name' => 'required',
            'model' => 'required',
            'category_id' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $bike->update($request->all());
        return redirect()->route('bikes.index')->with('success', 'Bike updated successfully.');
    }

    public function destroy(Bike $bike)
    {
        $bike->delete();
        return redirect()->route('bikes.index')->with('success', 'Bike deleted successfully.');
    }
}

