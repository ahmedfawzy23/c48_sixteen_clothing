<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class CartCount extends Component
{

    public int $count = 0;

    public function mount()
    {
        $this->updateCount();
    }

    #[On('cart-updated')]

    public function updateCount()
    {
        if (auth()->check()) {
            $this->count = auth()->user()->cartItems()->sum('quantity');
        } else {
            $this->count = array_sum(session()->get('cart', []));
        }
    }
    public function render()
    {
        return view('livewire.cart-count');
    }
}
