<?php

namespace App\Http\Controllers;

use App\Models\Locations;
use App\Models\User;
use App\Models\Recipes;
use Illuminate\Http\Request;

class ApiRoutesController extends Controller
{
    
    public function fetchUsers()
    {
        $users = User::with("role", "location", "cooks")
                    ->whereNot("role_id","1")->get();

        if($users){
            return response()->json([
                "status" => true,
                "data" => $users->toArray()
            ], 201);
        }else{
            return response()->json([
                "status" => false,
                "data" => []
            ], 404);
        }
    }

    public function fetchRecipes()
    {
        $recipes =  Recipes::with('users', 'availabiliti', 'commercialData' , 'types', 'allergens', 'hashtags')
        ->whereNull('recipes.deleted_at')
        ->get();

        if($recipes){
            return response()->json([
                "status" => true,
                "data" => $recipes->toArray()
            ], 201);
        }else{
            return response()->json([
                "status" => false,
                "data" => []
            ], 404);
        }
    }

    public function fetchMunicipalities()
    {
        $municipalities = Locations::pluck('Municipality');

        if($municipalities){
            return response()->json([
                "status" => true,
                "data" => $municipalities->toArray()
            ], 201);
        }else{
            return response()->json([
                "status" => false,
                "data" => []
            ], 404);
        }
    }

}
