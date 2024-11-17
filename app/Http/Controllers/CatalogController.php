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
        return view('marketplace.index', compact('items'));  // Correct view path
    }

    // Show the form to add a new product
    public function create()
    {
        return view('marketplace.create');  // Correct view path
    }

    // Store the new product in the database
    public function store(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|url',
            'price' => 'required|numeric|min:0',
        ]);

        // Create a new CatalogItem
        CatalogItem::create($validated);

        // Redirect to catalog page with success message
        return redirect()->route('marketplace.index')->with('success', 'Product added successfully!');
    }
}
