<?php

namespace App\Http\Controllers;  // Correct namespace

use App\Models\CatalogItem;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    // Show the list of catalog items
    public function index()
    {
        // Retrieve all catalog items from the database
        $items = CatalogItem::all();

        // Return the view with the items data
        return view('marketplace.marketindex', compact('items'));  // Correct view path
    }

    // Show the form to add a new product
    public function create()
    {
        return view('marketplace.marketcreate');  // Correct view path
    }

    // Store the new product in the database
    public function store(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
            'price' => 'required|numeric|min:0',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Store the file in the 'public/uploads' directory
            $imagePath = $request->file('image')->store('uploads', 'public');
            $validated['image_url'] = '/storage/' . $imagePath; // Save path to the database
        }

        // Create a new CatalogItem
        CatalogItem::create($validated);

        // Redirect to catalog page with success message
        return redirect()->route('marketplace.marketindex')->with('success', 'Product added successfully!');
    }

    // Delete an item from the catalog
    public function destroy($id)
    {
        $item = CatalogItem::findOrFail($id); // Find the item by ID
        $item->delete(); // Delete the item from the database

        return redirect()->route('marketplace.marketindex')->with('success', 'Item deleted successfully!');
    }

}
