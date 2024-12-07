<?php
namespace App\Http\Controllers;

use App\Models\SoldBike;
use Illuminate\Http\Request;

class SoldBikeController extends Controller
{
    public function index()
    {
        // Get all sold bikes and pass to the view
        $soldBikes = SoldBike::with('bike', 'sale')->get();
        return view('sold_bikes.index', compact('soldBikes'));
    }

    public function store(Request $request)
    {
        // Store sold bike record
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
    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }
}
