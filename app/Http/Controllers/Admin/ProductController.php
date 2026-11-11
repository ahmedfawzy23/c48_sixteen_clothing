<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(6);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "category_id" => "required|exists:categories,id",
            "title" => "required|string|max:255",
            'description' => 'required|string',
            "price" => 'required|string|numeric|min:0',
            "stock" => 'required|string|integer|min:0',
            "image" => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // $validated['image'] = time() . "_." . $request->file('image')->getClientOriginalExtension();
        // $request->file('image')->move(public_path('site/products'), $validated['image']);
        $validated['image'] = $request->file('image')->store('products', 'public');

        $validated['slug'] = Str::slug($validated['title']);
        Product::create($validated);
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            "category_id" => "required|exists:categories,id",
            "title" => "required|string|max:255",
            'description' => 'required|string',
            "price" => 'required|string|numeric|min:0',
            "stock" => 'required|string|integer|min:0',
            "image" => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $oldImage = $product->getRawOriginal('image');
            if ($oldImage && !str_starts_with($oldImage, 'http') && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $oldImage = $product->getRawOriginal('image');
        if ($oldImage && !str_starts_with($oldImage, 'http') && Storage::disk('public')->exists($oldImage)) {
            Storage::disk('public')->delete($oldImage);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }

    public function toggle(Product $product)
    {
        $product->is_active = !$product->is_active; // 0 1
        $product->save();
        return redirect()->back()->with('success', 'Product updated successfully');
    }
}
