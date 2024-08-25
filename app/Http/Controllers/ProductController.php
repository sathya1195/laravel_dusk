<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();  
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|min:3|max:50',
            'description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
        ]);


        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->save();

        return redirect('/products/create')->with('success', 'Product created successfully');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id); 
        return view('products.show', compact('product'));
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);  
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:50',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect('/products/' . $product->id . '/edit')->with('success', 'Product updated successfully');
    }
}

