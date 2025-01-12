<?php

namespace App\Http\Controllers;  // Correct namespace

use App\Models\CatalogItem;
use App\Models\Order;
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

    public function addToCart($id)
    {
        // Get the item by its ID
        $item = CatalogItem::findOrFail($id);

        // Add the item to the cart (using session, database, etc.)
        $cart = session()->get('cart', []);

        // Add or update the item in the cart
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => 1,
                'image_url' => $item->image_url
            ];
        }

        session()->put('cart', $cart);

        // Redirect to the cart view
        return redirect()->route('marketplace.cartview');
    }


    public function viewCart()
    {
        // dd("test");
        // Get all cart items from the session
        $cart = session()->get('cart', []);
    
        // Return the cart view with cart data
        return view('marketplace.cartview', ['cart' => $cart]);
    }

    public function testing()
    {
        return view('marketplace.test');
    }

    public function checkout()
    {
        // Example data for demonstration
        $cart = session('cart', []); // Assuming cart data is stored in the session
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        return view('marketplace.marketcheckout', compact('cart', 'total'));
    }
 

    public function placeOrder(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('checkout')->with('error', 'Your cart is empty.');
        }

        // Example: Save the order to the database (not implemented)
        session()->forget('cart'); // Clear the cart

        return redirect()->route('marketplace.marketindex')->with('success', 'Order placed successfully!');
    }

    // Show the order details form
    public function showOrderForm()
    {
        return view('marketplace.orderdetails'); // Ensure the view file is named 'orderdetails.blade.php'
    }

    // Handle the form submission
    public function confirmOrder(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'receipt' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Save the uploaded receipt
        if ($request->hasFile('receipt')) {
            $filePath = $request->file('receipt')->store('receipts', 'public');
        }
    
        // Handle the form data (e.g., save to the database, send an email, etc.)
        // Example:
        Order::create([
            'name' => $validatedData['name'],
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'receipt_path' => $filePath ?? null,
        ]);
    
        // Redirect or return a response
        return redirect()->route('marketplace.marketindex')->with('success', 'Order confirmed successfully!');
    }
    

    public function removeFromCart(Request $request, $id)
    {
        // Fetch the cart from session or database
        $cart = session()->get('cart', []);
    
        // Check if the item exists in the cart
        if (isset($cart[$id])) {
            // Remove the item from the cart
            unset($cart[$id]);
    
            // Save the updated cart back to the session
            session()->put('cart', $cart);
    
            // Provide feedback to the user
            return redirect()->back()->with('success', 'Item removed from the cart.');
        }
    
        return redirect()->back()->with('error', 'Item not found in the cart.');
    }
    

}
