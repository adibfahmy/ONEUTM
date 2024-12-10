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

    public function show($id)
    {
        $item = CatalogItem::findOrFail($id); // Adjust `CatalogItem` to your model name
        return view('marketplace.marketshow', compact('item'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        // Fetch all items or filter by search query
        $items = CatalogItem::when($query, function ($queryBuilder, $query) {
            $queryBuilder->where('name', 'LIKE', "%$query%")
                        ->orWhere('description', 'LIKE', "%$query%");
        })->get();

        // Return the view with items
        return view('marketplace.marketindex', compact('items'));
    }

    public function clearSearch()
    {
        // Simply redirect back to the market index (show all items)
        return redirect()->route('marketplace.marketindex');
    }

    public function edit($id)
    {
        $item = CatalogItem::findOrFail($id);
        return view('marketplace.marketedit', compact('item'));
    }


    public function update(Request $request, $id)
    {
        $item = CatalogItem::findOrFail($id);

        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update the item's properties
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->price = $request->input('price');

        // Handle the image upload, if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('catalog', 'public');
            $item->image_url = $imagePath;
        }

        // Save the updated item to the database
        $item->save();

        // Redirect back to the catalog with a success message
        return redirect()->route('marketplace.marketindex')->with('success', 'Item updated successfully!');
    }


}
