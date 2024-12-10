<?PHp

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Redirect Root to Login or Dashboard
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Authenticated Routes Group
Route::middleware('auth')->group(function () {
    // Profile Management Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Inventory Management Routes for Bikes
    Route::resource('bikes', BikeController::class);

    // Inventory Management Routes for Categories
    Route::resource('categories', CategoryController::class);

    // Sell Management Routes
    Route::resource('sell', SellController::class);
    Route::resource('sold_bikes', \App\Http\Controllers\SoldBikeController::class);

    // Barcode Search Route for Sell
    Route::get('/api/sell/barcode/{barcode}', [SellController::class, 'getBikeByBarcode']);
});

// Include Authentication Routes (Breeze)
require __DIR__ . '/auth.php';
