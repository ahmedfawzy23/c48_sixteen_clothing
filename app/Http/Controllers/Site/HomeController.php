<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $about = About::first();
        $products = Product::select('id', 'title', 'description', 'price', 'image')
            ->active()
            ->latest()
            ->take(6)
            ->get();
        // dd($products);
        return view('site.home', compact('products', 'about'));
    }
}
