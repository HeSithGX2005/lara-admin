<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show the form for adding a product
    public function create()
    {
        return view('addproducts');
    }

    // Store the product details in the database
    public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        // Use only the allowed fields for mass assignment
        Product::create($request->only(['name', 'description', 'price', 'quantity']));

        // Redirect back to the home page with a success message
        return redirect('/home')->with('success', 'Product added successfully.');
    }
}
