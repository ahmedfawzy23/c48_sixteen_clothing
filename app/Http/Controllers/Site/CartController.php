<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $totalPrice = 0;


        if (!empty($cart)) {
            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)->get();

            foreach ($products as $product) {
                $subTotal = $product->price * $cart[$product->id];
                $totalPrice += $subTotal;
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $cart[$product->id],
                    'subTotal' => $subTotal
                ];
            }
        }

        return view('site.cart.index', compact('cartItems', 'totalPrice'));
    }


    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => "required|integer|exists:products,id",
            'quantity' => 'required|integer|min:1'
        ]);
        $cart = session()->get('cart', []);

        $product = Product::findOrFail($validated['product_id']);
        $currentQty = $cart[$product->id] ?? 0;
        $newQty = $currentQty + $validated['quantity'];

        if ($newQty > $product->stock) {
            return redirect()->back()->with('error', 'Stock limit exceeded');
        }

        $cart[$product->id] = $newQty;
        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', "Product added to cart");
    }

    public function remove(Product $product) // clear not found
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', "Product removed from cart");
    }
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', "All Products removed from cart");
    }
}
