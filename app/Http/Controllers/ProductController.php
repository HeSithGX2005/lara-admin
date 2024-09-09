<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // Import the Category model
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show the form for adding a product
    public function create()
    {
        // Fetch all categories to display in the form
        $categories = Category::all();
        return view('addproducts', compact('categories'));
    }

    // Store the product details in the database
    public function store(Request $request)
    {
        // Validate the form input, including category
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id', // Ensure category exists
        ]);

        // Use only the allowed fields for mass assignment
        Product::create($request->only(['name', 'description', 'price', 'quantity', 'category_id']));

        // Redirect back to the products list with a success message
        return redirect('/products')->with('success', 'Product added successfully.');
    }

    // Show all products
    public function index()
    {
        // Load products with their associated categories
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    // Show the form for editing a specific product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Fetch all categories
        return view('products.edit', compact('product', 'categories'));
    }

    // Update the specified product in the database
    public function update(Request $request, $id)
    {
        // Validate the form input, including category
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id', // Ensure category exists
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only(['name', 'description', 'price', 'quantity', 'category_id']));

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}

