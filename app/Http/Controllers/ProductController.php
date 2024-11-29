<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;

class ProductController extends Controller
{
    public function index(): Factory
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create(): Factory
    {
        return view('products.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product added successfully');
    }

    public function edit(Product $product): Factory
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product): \Illuminate\Http\RedirectResponse
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
    //
}
