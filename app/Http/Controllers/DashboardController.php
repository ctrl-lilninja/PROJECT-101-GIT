<?php
namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Sale;
use App\Models\SoldBike;  // Corrected import to use SoldBike
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    // Get the bikes and sales data
    $availableBikes = Bike::where('quantity', '>', 0)->get();  // Fetch bikes, not just count

    // Calculate sales statistics
    $salesToday = Sale::whereDate('created_at', Carbon::today())->sum('total_amount');
    $salesWeek = Sale::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total_amount');
    $salesMonth = Sale::whereMonth('created_at', Carbon::now()->month)->sum('total_amount');
    $salesYear = Sale::whereYear('created_at', Carbon::now()->year)->sum('total_amount');

    // Calculate total bikes sold and sold by type
    $totalBikesSold = SoldBike::sum('quantity');
    $soldBikesByType = SoldBike::join('bikes', 'sold_bikes.bike_id', '=', 'bikes.id')
                               ->select('bikes.name', DB::raw('SUM(sold_bikes.quantity) as total'))
                               ->groupBy('bikes.name')
                               ->pluck('total', 'name')->toArray();

    // For date range filter (optional)
    $startDate = $request->input('start_date', Carbon::today()->toDateString());
    $endDate = $request->input('end_date', Carbon::today()->toDateString());
    $salesInRange = Sale::whereBetween('created_at', [$startDate, $endDate])->sum('total_amount');

    // Return view with all necessary data
    return view('dashboard', compact('availableBikes', 'salesToday', 'salesWeek', 'salesMonth', 'salesYear', 'totalBikesSold', 'soldBikesByType', 'salesInRange'));
}

}
