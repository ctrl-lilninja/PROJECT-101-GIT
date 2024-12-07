<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Sale;
use App\Models\SoldBike;
use Illuminate\Http\Request;

class SellController extends Controller
{
    // Show the list of all sales and handle barcode search
    public function index(Request $request)
{
    $bikes = Bike::all(); // Get all available bikes
    $sales = Sale::with('soldBikes.bike')->get(); // Eager load soldBikes and associated bike

    $foundBike = null;

    // Check if a barcode was provided in the request
    if ($request->has('barcode')) {
        $foundBike = Bike::where('barcode', $request->input('barcode'))->first();
    }

    return view('sell.index', compact('sales', 'bikes', 'foundBike'));
}


    // Store a new sale
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'buyer_name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'bike_id' => 'required|exists:bikes,id',  // Bike ID validation
            'quantity' => 'required|integer|min:1',
        ]);

        // Find the bike
        $bike = Bike::find($request->bike_id);

        // Check if there is enough stock
        if ($bike->quantity < $request->quantity) {
            return back()->with('error', 'Not enough stock for this bike!');
        }

        // Calculate total amount
        $totalAmount = $bike->price * $request->quantity;

        // Create a sale record
        $sale = Sale::create([
            'buyer_name' => $request->buyer_name,
            'contact' => $request->contact,
            'address' => $request->address,
            'total_amount' => $totalAmount,
        ]);

        // Store the sold bike record
        SoldBike::create([
            'sale_id' => $sale->id,
            'bike_id' => $bike->id,
            'quantity' => $request->quantity,
        ]);

        // Update the bike quantity
        $bike->quantity -= $request->quantity;
        $bike->save();

        // Return to the sale list with success message
        return redirect()->route('sell.index')->with('success', 'Bike sold successfully!');
    }
}
