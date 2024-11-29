<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all(); // Get all categories from the database
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image type and size
    ]);

    $category = new Category();
    $category->name = $request->name;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
        
        // Store the image in the 'public/categories' directory
        $image->storeAs('categories', $imageName, 'public');

        // Save the image path in the database (to the image column)
        $category->image = $imageName;
    }

    $category->save();

    return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    public function show(Category $category)
    {
        // Fetch all bikes for this specific category using the relationship defined in the Category model
        $bikes = $category->bikes; // This ensures it fetches only the bikes that belong to this category

        // Return the category view with bikes
        return view('categories.show', compact('category', 'bikes'));
    }
    
    public function create()
    {
        return view('categories.create');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->only('name')); // Update category

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete(); // Delete category
        return redirect()->route('categories.index');
    }
}
