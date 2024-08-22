<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ProductController extends Controller
{
    
    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'stock' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $product = new Product($request->except('image'));

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('home');
    }

    public function edit(Product $product)
    {
        return view('admin.edit', compact('product'));
    }

    
    public function update(Request $request, Product $product)
    {
       
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');

       
        if ($request->hasFile('image')) {
            if ($product->image) {
                $oldImagePath = storage_path('app/public/' . $product->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('home')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
       
        if ($product->image) {
            $imagePath = storage_path('app/public/' . $product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $product->delete();

        return redirect()->route('home')->with('success', 'Product deleted successfully.');
    }
}
