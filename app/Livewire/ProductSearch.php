<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductSearch extends Component
{
    use WithPagination;
    #[Url]
    public string $search = '';


    public function addToCart(Product $product)
    {

        if (auth()->check()) {
            $cartItem = auth()->user()->cartItems()->where('product_id', $product->id)->first();

            $newQty =  ($cartItem ? $cartItem->quantity : 0) + 1;

            if ($newQty >  $product->stock) {
                $this->addError('product.' . $product->id, 'Stock limit exceeded');
                return;
            }

            if ($cartItem) {
                $cartItem->update(['quantity' => $newQty]);
            } else {
                auth()->user()->cartItems()->create([
                    'product_id' => $product->id,
                    'quantity' => $newQty
                ]);
            }
        } else {

            $cart = session()->get('cart', []);


            $newQty =  ($cart[$product->id] ?? 0) + 1;

            if ($newQty > $product->stock) {
                $this->addError('product.' . $product->id, 'Stock limit exceeded');
                return;
            }

            $cart[$product->id] = $newQty;
            session()->put('cart', $cart);
        }

        $this->dispatch('cart-updated');
    }
    public function render()
    {
        $products = Product::select('id', 'title', 'description', 'price', 'image', 'slug', 'stock')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', "%$this->search%")
                    ->orWhere('description', 'like', "%$this->search%");
            })
            ->active()
            ->latest()
            ->paginate(9)
            ->withQueryString();
        return view('livewire.product-search', ['products' => $products]);
    }
}
