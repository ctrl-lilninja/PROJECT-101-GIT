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

        return view('sell.index', compact('sales', 'bikes'));
    }

    // Store a new sale and update bike stock
    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'buyer_name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'bikes' => 'required|array',
            'bikes.*.bike_id' => 'required|exists:bikes,id',
            'bikes.*.barcode' => 'required|string', // Validate barcode
            'bikes.*.quantity' => 'required|integer|min:1',
        ]);

        // Start a transaction for database integrity
        \DB::beginTransaction();

        try {
            $totalAmount = 0;

            // Check bike stock and calculate the total amount
            foreach ($request->bikes as $bikeData) {
                $bike = Bike::find($bikeData['bike_id']);

                // Check if there's enough stock for the bike
                if ($bike->quantity < $bikeData['quantity']) {
                    \DB::rollBack();  // Rollback if stock is insufficient
                    return back()->with('error', "Not enough stock for bike: {$bike->name}. Available stock: {$bike->quantity}");
                }

                $totalAmount += $bike->price * $bikeData['quantity'];
            }

            // Create the sale record
            $sale = Sale::create([
                'buyer_name' => $request->buyer_name,
                'contact' => $request->contact,
                'address' => $request->address,
                'total_amount' => $totalAmount,
            ]);

            // Process each bike sale and update stock
            foreach ($request->bikes as $bikeData) {
                $bike = Bike::find($bikeData['bike_id']);

                // Record the sale of the bike
                SoldBike::create([
                    'sale_id' => $sale->id,
                    'bike_id' => $bike->id,
                    'quantity' => $bikeData['quantity'],
                ]);

                // Update stock quantity after sale
                $bike->quantity -= $bikeData['quantity'];
                $bike->save();
            }

            // Commit the transaction if everything is successful
            \DB::commit();

            // Log success and return to the index page with a success message
            return redirect()->route('sell.index')->with('success', 'Sale completed successfully!');
        } catch (\Exception $e) {
            // Rollback and log any error that occurs during the process
            \DB::rollBack();
            \Log::error("Error during sale: {$e->getMessage()}");

            return back()->with('error', 'An error occurred while completing the sale. Please try again.');
        }
    }

    // Show a specific sale's details
    public function show($id)
    {
        $sale = Sale::with('soldBikes.bike')->findOrFail($id);
        return view('sell.show', compact('sale'));
    }
}
