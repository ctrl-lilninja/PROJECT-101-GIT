<?php

namespace App\Http\Controllers;

use App\Models\SoldBike;
use Illuminate\Http\Request;

class SoldBikeController extends Controller
{
    // Display a listing of the sold bikes
    public function index()
    {
        // Eager load the 'bike' relationship for each soldBike
        $soldBikes = SoldBike::with('bike')->get();
        
        // Pass the data to the Blade view
        return view('sold_bikes.index', compact('soldBikes'));
    }

    // Store a new sold bike record
    public function store(Request $request)
    {
        $request->validate([
            'bike_id' => 'required|exists:bikes,id',
            'sale_id' => 'required|exists:sales,id',
            'quantity' => 'required|integer|min:1',
        ]);

        SoldBike::create([
            'bike_id' => $request->bike_id,
            'sale_id' => $request->sale_id,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('sold_bikes.index');
    }

    // Show details of a specific sold bike
    public function show($id)
    {
        // Retrieve the sold bike with the related bike and sale
        $soldBike = SoldBike::with('bike', 'sale')->findOrFail($id);
        return view('sold_bikes.show', compact('soldBike'));  // Pass the sold bike to the view
    }
}
