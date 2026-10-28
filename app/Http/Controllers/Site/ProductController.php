<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('id', 'title', 'description', 'price', 'image')
            ->active()
            ->latest()
            ->paginate(9);
        return view('site.products', compact('products'));
    }
}
