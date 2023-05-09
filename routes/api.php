<?php

use App\Http\Controllers\ApiRoutesController;
use Illuminate\Http\Request;
use App\Http\Livewire\RecipesCook;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CooksController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/users", [ApiRoutesController::class, "fetchUsers"]);
Route::get("/recipes", [ApiRoutesController::class, "fetchRecipes"]);
Route::get("/municipalities", [ApiRoutesController::class, "fetchMunicipalities"]);
