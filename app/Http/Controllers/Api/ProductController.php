<?php

namespace App\Http\Controllers\Api;

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
        return response()->json($products);
    }
}
