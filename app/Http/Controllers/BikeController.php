<?php
namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Category;
use Illuminate\Http\Request;

class BikeController extends Controller
{
    public function index(Request $request)
    {
        // Initialize the query builder for bikes
        $query = Bike::query();

        // Check if category_id is present in the query string
        if ($request->has('category_id')) {
            // Filter bikes by the selected category
            $query->where('category_id', $request->category_id);
        }

        // Check if search term is provided
        if ($request->has('search')) {
            // Filter bikes by name
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Execute the query and get the results
        $bikes = $query->get();

        // Pass bikes and any other necessary data to the view
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for photo
        ]);

        // Handle file upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->store('photos', 'public'); // Store in storage/app/public/photos
        }

        // Create a new bike and store the photo path
        Bike::create([
            'name' => $request->name,
            'model' => $request->model,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'barcode' => $request->barcode,
            'photo' => $photoPath, // Save the photo path to the database
        ]);

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
            'barcode' => 'nullable|string|max:255', // Barcode validation
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for photo
        ]);
    
        // Handle file upload for new photo
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($bike->photo && file_exists(storage_path('app/public/' . $bike->photo))) {
                unlink(storage_path('app/public/' . $bike->photo)); // Delete the old photo
            }
    
            // Store the new photo
            $photo = $request->file('photo');
            $photoPath = $photo->store('photos', 'public'); // Store in storage/app/public/photos
            $bike->photo = $photoPath; // Assign the new photo path to the bike
        }
    
        // Update the bike information
        $bike->name = $request->name;
        $bike->model = $request->model;
        $bike->category_id = $request->category_id;
        $bike->quantity = $request->quantity;
        $bike->price = $request->price;
        $bike->barcode = $request->barcode; // Update barcode explicitly
        $bike->save(); // Save the updated bike
    
        return redirect()->route('bikes.index');
    }

    public function destroy(Bike $bike)
    {
        // Delete the bike
        $bike->delete();
        return redirect()->route('bikes.index');
    }
}
