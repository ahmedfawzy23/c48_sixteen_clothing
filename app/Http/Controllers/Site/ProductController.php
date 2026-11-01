<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $products = Product::select('id', 'title', 'description', 'price', 'image', 'slug')
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            })
            ->active()
            ->latest()
            ->paginate(9)
            ->withQueryString();
        return view('site.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('site.products.show', compact('product'));
    }
}
