<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public int $count = 0;
    public string $name = '';

    public function increase()
    {
        $this->count++;
    }
    public function decrease()
    {
        $this->count--;
    }
    public function render()
    {
        return view('livewire.counter');
    }
}
