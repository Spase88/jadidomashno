<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\OrderPlacedMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MyRecipesController extends Controller
{
    public function store(Request $request)
    {
        $cart = session('cart', []);
        $groupedOrders = [];

        foreach ($cart as $key => $item) {
            $now = Carbon::now();
            $now->setTimezone('Europe/Skopje');
            $orderedAt = $now->format('Y-m-d H:i:s');
            $data = [
                'recipe_id' => $item['recipe_id'],
                'cook_id' => $item['cook_id'],
                'gourmet_id' => $item['gourmet_id'],
                'quantity' => $request->input('quantity')[$key],
                'ordered_at' => $orderedAt, // set default value for date
                'delivery_method' => $request->input('delivery_method')[$key], // get delivery method for each item
                'price' => $item['recipe']->commercialData->promotional_price_per_meal * $request->input('quantity')[$key]
            ];
        
            DB::table('carts')->insert($data);

            $cook = User::find($item['cook_id']);
            $gourmet = User::find($item['gourmet_id']);

            $cookEmail = $cook->email;
            $recipeName = $item['recipe']->recipe_name;
            $quantity = $request->input('quantity')[$key];
            $price = $item['recipe']->commercialData->promotional_price_per_meal * $quantity;

            Mail::to($cookEmail)->send(new OrderPlacedMail($cook, $gourmet, $recipeName, $quantity, $price));
        }

        session()->forget('cart');

        return redirect()->route('homepage')->with('success', 'Вашата нарачка е направена!');
    }

}
