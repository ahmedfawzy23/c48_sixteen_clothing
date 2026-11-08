<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $cartItems = $user->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->product->price * $item->quantity;
        }

        return view('site.checkout', compact('cartItems', 'totalPrice'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
        ]);
        $user = auth()->user();

        $order = DB::transaction(function () use ($user, $validated) {
            $cartItems = $user->cartItems()->with('product')->lockForUpdate()->get();

            if ($cartItems->isEmpty()) {
                return null;
            }
            $totalPrice = 0;
            foreach ($cartItems as $item) {
                $totalPrice += $item->product->price * $item->quantity;
            }


            $order = $user->orders()->create([
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'shipping_address' => $validated['shipping_address'],
                'total' => $totalPrice,
            ]);

            foreach ($cartItems as $item) {
                if ($item->product) {

                    $order->orderItems()->create([
                        'product_name' => $item->product->title,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price,
                    ]);
                }
            }

            $user->cartItems()->delete();

            return $order;
        });

        if (!$order) {
            return redirect()->route('cart.index')->with('error', 'Failed to place order. Please try again');
        }
        return redirect()->route('home')->with('success', 'Order placed successfully');
    }
}
