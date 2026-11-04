<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $user;
    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function index()
    {

        $cartItems = [];
        $totalPrice = 0;


        if ($this->user) {
            $this->getUserCart($this->user, $cartItems, $totalPrice);
        } else {
            $this->getGuestCart($cartItems, $totalPrice);
        }

        return view('site.cart.index', compact('cartItems', 'totalPrice'));
    }

    private function getUserCart(User $user, &$cartItems, &$totalPrice)
    {
        $cart = $user->cartItems()->with('product')->get();
        if (!empty($cart)) {
            foreach ($cart as $item) {
                $subTotal = $item->product->price * $item->quantity;
                $totalPrice += $subTotal;
                $cartItems[] = [
                    'product' =>  $item->product,
                    'quantity' => $item->quantity,
                    'subTotal' => $subTotal
                ];
            }
        }
    }

    private function getGuestCart(&$cartItems, &$totalPrice)
    {
        $cart = session()->get('cart', []);
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
    }


    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => "required|integer|exists:products,id",
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($this->user) {
            $cartItem = $this->user->cartItems()->where('product_id', $validated['product_id'])->first();
            $currentQty = $cartItem ? $cartItem->quantity : 0;
            $newQty =  $currentQty + $validated['quantity'];
            if ($newQty >  $product->stock) {
                return redirect()->back()->with('error', 'Stock limit exceeded');
            }

            if ($cartItem) {
                $cartItem->update(['quantity' => $newQty]);
            } else {
                $this->user->cartItems()->create([
                    'product_id' => $product->id,
                    'quantity' => $newQty
                ]);
            }
        } else {

            $cart = session()->get('cart', []);


            $currentQty = $cart[$product->id] ?? 0;
            $newQty = $currentQty + $validated['quantity'];

            if ($newQty > $product->stock) {
                return redirect()->back()->with('error', 'Stock limit exceeded');
            }

            $cart[$product->id] = $newQty;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', "Product added to cart");
    }
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validated['quantity'] > $product->stock) {
            return redirect()->back()->with('error', 'Stock limit exceeded');
        }


        if ($this->user) {
            $this->user->cartItems()->where('product_id', $product->id)->update([
                'quantity' => $validated['quantity']
            ]);
        } else {
            $cart = session()->get('cart', []);
            $cart[$product->id] = $validated['quantity'];
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', "Product Quantity updated successfully");
    }

    public function remove(Product $product) // clear not found
    {
        if ($this->user) {

            $cartItem = $this->user->cartItems()->where('product_id', $product->id)->first();
            if ($cartItem) {
                $cartItem->delete();
            }
        } else {

            $cart = session()->get('cart', []);
            if (isset($cart[$product->id])) {
                unset($cart[$product->id]);
                session()->put('cart', $cart);
            }
        }
        return redirect()->route('cart.index')->with('success', "Product removed from cart");
    }
    public function clear()
    {
        if ($this->user) {
            $this->user->cartItems()->delete();
        } else {
            session()->forget('cart');
        }

        return redirect()->route('cart.index')->with('success', "All Products removed from cart");
    }
}
