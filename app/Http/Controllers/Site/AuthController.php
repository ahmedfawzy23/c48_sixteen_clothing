<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('site.auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
        // $validated['password'] = bcrypt($validated['password']);
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        auth()->login($user);
        $this->syncSessionCartToDatabase($user);




        session()->regenerateToken();
        return redirect()->route('home')->with('success', 'User register successfully');
    }

    public function showLoginForm()
    {
        return view('site.auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        if (!Hash::check($validated['password'], $user->password)) {
            return redirect()->back()->with('error', 'User not found');
        }

        auth()->login($user);
        $this->syncSessionCartToDatabase($user);

        session()->regenerateToken();
        return redirect()->route('home')->with('success', 'User Login successfully');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'User Logout successfully');
    }


    private function syncSessionCartToDatabase(User $user)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return;
        }

        foreach ($cart as $product_id => $quantity) {
            $product = Product::find($product_id);
            if (!$product) continue;

            $cartItem = $user->cartItems()->where('product_id', $product->id)->first();
            $curruntQty = $cartItem ? $cartItem->quantity : 0;
            $newQty = $curruntQty + $quantity;

            $finalQty = min($newQty, $product->stock);

            $user->cartItems()->updateOrCreate(
                ['product_id' => $product->id],
                ['quantity' => $finalQty]
            );
        }
    }
}
