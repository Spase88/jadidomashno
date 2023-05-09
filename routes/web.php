<?php

use App\Http\Livewire\Alergens;
use App\Http\Livewire\CooksForm;
use App\Http\Livewire\MyRecipes;
use App\Http\Livewire\Categories;
use App\Http\Livewire\RecipesCook;
use App\Http\Livewire\HomepageCards;
use App\Http\Livewire\CooksDashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MyRecipesController;


Route::get("/dashboard", [DashboardController::class, "dashboardIndex"])
    ->middleware(['auth', 'verified',"Role"])->name('dashboard');

Route::middleware(['auth', 'verified', 'AdminOnly'])->group(function () {
    Route::get("/allergens", [Alergens::class, "allergensIndex"])->name("allergensIndex");
    Route::get("/categories", [Categories::class, "categoriesIndex"])->name("categoriesIndex");
});

Route::middleware(['auth', 'verified', 'CooksOnly'])->group(function () {
    Route::get("/cooks-info", [CooksForm::class, "cooksInfo"])->name("cooksInfo");
    Route::get("/cooks-info-current", [CooksForm::class, "getCurrentCooksInfo"])->name("getCurrentCooksInfo");
    Route::get("/cooks", [CooksDashboard::class, "showIndex"])->name("cooks");
    Route::get("/cooks-orders",[CooksDashboard::class, "fetchOrders"])->name("cooksOrders");
    Route::get("/add-recipes",[RecipesCook::class, "cooksRecipes"])->name("RecipesIndex");
});

Route::middleware(['auth', 'verified', 'UsersOnly'])->group(function () {
    Route::get("/user", [DashboardController::class, "userDashboard"])->name("userDashboard");
    Route::get("/my-recipes", [MyRecipes::class, "myRecipesIndex"])->name("my-recipes");
    Route::post("/my-recipes", [MyRecipesController::class, 'store'])->name('storeMyRecipes');
});
Route::get("/", [HomepageCards::class, "index"])->name("homepage");

require __DIR__.'/auth.php';
