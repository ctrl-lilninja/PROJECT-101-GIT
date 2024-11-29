<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

// Redirect Root to Login or Dashboard
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Dashboard Route - Pass categories to the view
Route::get('/dashboard', function () {
    $categories = Category::all();  // Fetch all categories
    return view('dashboard', compact('categories'));  // Pass categories to the view
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated Routes Group
Route::middleware('auth')->group(function () {
    // Profile Management Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Inventory Management Routes
    Route::resource('bikes', BikeController::class); // This will automatically handle all routes for CRUD
    Route::resource('categories', CategoryController::class); // This will automatically handle all routes for CRUD
    
    // Custom Category Routes (For clarity, the resource route already covers these, but you can add if needed)
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    
    // Single Category Show Route - Display bikes of a specific category
    Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
});

// Include Authentication Routes (Breeze)
require __DIR__.'/auth.php';
