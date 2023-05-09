<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboardIndex() //For Admin dashboard
    {
        $users = User::whereNot("role_id", "1")->with("role")->get();

        return view('dashboard', compact("users"));
    }
    public function userDashboard() //For gourment users
    {
        $userId = Auth::id();

        $orders = DB::table('carts')
            ->join('recipes', 'carts.recipe_id', '=', 'recipes.id')
            ->join('users', 'carts.cook_id', '=', 'users.id')
            ->where('carts.gourmet_id', '=', $userId)
            ->select('carts.*', 'recipes.recipe_name', 'users.name AS cook_name', "users.lastname AS cook_lastname")
            ->orderBy('ordered_at', 'desc')
            ->get();

        return view('dashboard', compact("orders"));
    }
}
