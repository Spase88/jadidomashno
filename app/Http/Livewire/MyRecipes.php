<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MyRecipes extends Component
{
    public $recipes = [];
    public $quantity;
    public $delivery_method;

    public function mount()
    {
        $this->recipes = $this->fetchCurrentRecipes();
    }
    public function myRecipesIndex()
    {
        $recipes = $this->fetchCurrentRecipes();
        return view('myRecipes', compact('recipes'));
    }
    private function fetchCurrentRecipes()
    {
        return session('cart', []);
    }
    public function removeFromCart($key)
    {
        $cart = session()->get('cart');

        if (array_key_exists($key, $cart)) {
            unset($cart[$key]);
            session()->put('cart', $cart);
            $this->recipes = $this->fetchCurrentRecipes();
        }
    }
    public function submitRecipes()
    {
        $this->recipes = $this->fetchCurrentRecipes();
    }
}
