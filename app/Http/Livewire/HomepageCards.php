<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Recipes;
use Livewire\Component;
use App\Models\CommercialData;
use Illuminate\Foundation\Auth\User;

class HomepageCards extends Component
{
    public $recipes;

    public function index()
    {
        $recipes =  Recipes::with('users', 'availabiliti', 'commercialData' , 'types', 'allergens', 'hashtags')
        ->whereNull('recipes.deleted_at')
        ->get();
        session()->forget('cart');
        return view("welcome", compact("recipes"));
    }
    public function addToCart($recipeID, $cook_id)
    {
        $cart = session()->get('cart');


        if (!is_array($cart)) {
            $cart = [];
        }
        $key = $recipeID . '_' . $cook_id;
        if (array_key_exists($key, $cart)) {
            $this->dispatchBrowserEvent("error", ['message' => 'Овој рецепт веќе е во кошничката!']);
            return;
        } else {
            $recipe = Recipes::find($recipeID);
            $commercialData = CommercialData::find($recipe->commercialData->id);
            $cart[$key] = [
                "recipe" => $recipe,
                "recipe_id" => $recipeID,
                "gourmet_id" => auth()->user()->id,
                "cook_id" => $cook_id,
                "quantity" => 1,
                "commercial_data" => $commercialData,
            ];
        }

        $this->dispatchBrowserEvent("success", ['message' => 'Рецептот е додаден во кожничката!']);
        session()->put('cart', $cart);
    }
}
