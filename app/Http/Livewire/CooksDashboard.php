<?php

namespace App\Http\Livewire;

use Exception;
use App\Models\Types;
use App\Models\Hastags;
use App\Models\Recipes;
use Livewire\Component;
use App\Models\Allergens;
use App\Models\Availability;
use Livewire\WithFileUploads;
use App\Models\CommercialData;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CooksDashboard extends Component
{
    use WithFileUploads;

    public $recipes;
    public $recipe_name;
    public $description;
    public $recipe_id;
    public $recipe_image;
    public $hastag_name;
    public $allAllergens;
    public $allTypes;
    public $types;
    public $selectedTypes = [];
    public $selectedAllergens = [];
    public $allergens;
    public $selectedForDeletingRecipe = 0;
    public $promotional_price_duration;
    public $portion_size;
    public $ingredients;
    public $spiciness;
    public $price_per_meal;
    public $promotional_price_per_meal;
    public $warm_up_instructions;
    public $comment;
    public $date_available_from;
    public $date_available_to;
    public $serving_numbers;

    protected $rules = [
        'recipe_name' => 'required|regex:/^.*$/|min:2|max:20',
        'description' => 'required|regex:/^.*$/|min:2|max:1500',
        "recipe_image" => "nullable|max:1024",
        "hastag_name" => "required|string|regex:/^(?:#[a-zA-Z0-9_\p{Cyrillic}]+)(?:\s*,*\s*#[a-zA-Z0-9_\p{Cyrillic}]+)*$/mu|max:255",
        "allergens" => "required|array|min:1",
        "promotional_price_duration" => "required|date",
        "portion_size" => "required|regex:/^[A-Za-z0-9\x{0400}-\x{04FF}\s.,!?\"\-]+$/u|max:255",
        "ingredients" => "required|regex:/^[A-Za-z0-9\x{0400}-\x{04FF}\s.,!?\"\-]+$/u|max:255",
        "spiciness" => "required|regex:/^[A-Za-z0-9\x{0400}-\x{04FF}\s.,!?\"\-]+$/u|max:255",
        "price_per_meal" => "required|integer|min:1",
        "promotional_price_per_meal" => "required|integer|min:1",
        "warm_up_instructions" => "required|regex:/^[A-Za-z0-9\x{0400}-\x{04FF}\s.,!?\"\-]+$/u",
        "comment" => "required|regex:/^[A-Za-z0-9\x{0400}-\x{04FF}\s.,!?\"\-]+$/u",
    ];
    protected $messages = [

        'recipe_name.required' => 'Полето за :attribute е задолжително.',
        'recipe_name.regex' => 'Полето за :attribute е невалидно.',
        'recipe_name.min' => 'Внесете минимум 2 карактери.',
        'recipe_name.max' => 'Полето за :attribute не смее да биде поголемо од 20 знаци.',

        'description.required' => 'Полето за :attribute е задолжително.',
        'description.regex' => 'Полето за :attribute е невалидно.',
        'description.min' => 'Внесете минимум 2 карактери.',
        'description.max' => 'Полето за :attribute не смее да биде поголемо од 1500 знаци.',

        'recipe_image.required' => 'Полето за :attribute е задолжително.',
        'recipe_image.image' => 'Полето мора да биде слика.',
        'recipe_image.max' => 'Полето за :attribute не смее да биде поголемо од 1MB|1024kb.',

        'hastag_name.required' => 'Полето за :attribute е задолжително.',
        'hastag_name.string' => 'Внесете валиден формат.',
        'hastag_name.regex' => 'Пример за валиден хаштаг: #сочно,#домашно,#супа',
        'hastag_name.max' => 'Полето за :attribute не смее да биде поголемо од 255 карактери.',

        'allergens.required' => 'Полето за :attribute е задолжително.',
        'allergens.min' => 'Изберете барем 1 :attribute',

        "promotional_price_duration.required" => 'Полето за :attribute е задолжително.',
        "promotional_price_duration.date" => 'Полето за :attribute мора да е дата.',

        "portion_size.required" => 'Полето за :attribute е задолжително.',
        "portion_size.regex" => 'Полето за :attribute не е валидно.',
        "portion_size.max" => 'Полето за :attribute не смее да има повеќе од 255 карактери.',

        "ingredients.required" => 'Полето за :attribute е задолжително.',
        "ingredients.regex" => 'Полето за :attribute не е валидно.',
        "ingredients.max" => 'Полето за :attribute не смее да има повеќе од 255 карактери.',

        "spiciness.required" => 'Полето за :attribute е задолжително.',
        "spiciness.regex" => 'Полето за :attribute не е валидно.',
        "spiciness.max" => 'Полето за :attribute не смее да има повеќе од 255 карактери.',

        "price_per_meal.required" => 'Полето за :attribute е задолжително.',
        "price_per_meal.integer" => 'Полето за :attribute мора да е од тип број.',
        "price_per_meal.min" => 'Полето за :attribute мора да биде барем 1.',

        "promotional_price_per_meal.required" => 'Полето за :attribute е задолжително.',
        "promotional_price_per_meal.integer" => 'Полето за :attribute мора да е од тип број.',
        "promotional_price_per_meal.min" => 'Полето за :attribute мора да биде барем 1.',

        "warm_up_instructions.required" => 'Полето за :attribute е задолжително.',
        "warm_up_instructions.regex" => 'Полето за :attribute не е валидно.',

        "comment.required" => 'Полето за :attribute е задолжително.',
        "comment.regex" => 'Полето за :attribute не е валидно.',
        "comment.max" => 'Полето за :attribute не смее да има повеќе од 255 карактери.',

        "date_available_from.required" => 'Полето за :attribute е задолжително.',
        "date_available_from.date" => 'Полето за :attribute мора да е дата.',
        "date_available_from.after_or_equal" => 'Полето за :attribute мора да биде датум после или еднаков на денешниот.',

        "date_available_to.required" => 'Полето за :attribute е задолжително.',
        "date_available_to.date" => 'Полето за :attribute мора да е дата.',
        "date_available_to.after_or_equal" => 'Полето за :attribute мора да биде датум после или еднаков на денешниот.',


        "serving_numbers.required" => 'Полето за :attribute е задолжително.',
        "serving_numbers.integer" => 'Полето за :attribute мора да е од тип број.',
        "serving_numbers.min" => 'Полето за :attribute мора да биде барем 1.',
        
        
    ];

    protected $validationAttributes = [
        'recipe_name' => 'име на рецепт',
        "description" => "опис",
        "recipe_image" => "слика",
        "hastag_name" => "хаштаг",
        "allergens" => "алерген",
        "promotional_price_duration" => "времетраење на промотивна цена",
        "portion_size" => "големина на порцијата",
        "ingredients" => "состојќи",
        "spiciness" => "лутина",
        "price_per_meal" => "цена по оброк",
        "promotional_price_per_meal" => "промотивна цена по оброк",
        "warm_up_instructions" => "инструкции за загевање",
        "comment" => "коментар",
        "date_available_from" => "почетна дата",
        "date_available_to" => "завршна дата",
        "serving_numbers" => "број на порции",
    ];

    public function showIndex()
    {
        $recipes = $this->fetchRecipes();
        $allAllergens = Allergens::all();
        $allTypes = Types::all();
        return view('dashboard', compact('recipes', "allAllergens", "allTypes"));
    }

    public function fetchRecipes()
    {
        $user = Auth::user();

        if ($user) {
            return Recipes::with('users', 'availability')
                ->where('user_id', $user->id)
                ->get();
        }

    }

    public function changeDelete($recipe)
    {
        $this->selectedForDeletingRecipe = $recipe;
    }

    public function deleteRecipe()
    {
        if($this->selectedForDeletingRecipe == 0){   
            return;
        }

        $recipe = Recipes::findOrFail($this->selectedForDeletingRecipe);
        $recipe->delete();
        $this->recipes = $this->fetchRecipes();
        $this->selectedForDeletingRecipe = 0;
        $this->dispatchBrowserEvent("success", ['message' => 'Рецептот е избришан!']);
    }
    public function editRecipe($recipeID)
    {
        $recipe = Recipes::find($recipeID);
        if($recipe){
            $this->recipe_id = $recipe->id;
            $this->recipe_name = $recipe->recipe_name;
            $this->description = $recipe->description;
            $this->recipe_image = $recipe->recipe_image;

            $this->hastag_name = $recipe->hashtags()->pluck('hastag_name')->implode(',');

            $selectedAllergens = $recipe->allergens()->pluck('id')->toArray();
            $this->allergens = array_fill_keys($selectedAllergens, true);

            $selectedTypes = $recipe->types()->pluck('id')->toArray();
            $this->types = array_fill_keys($selectedTypes, true);

            $commercialData = $recipe->commercialData;

            $this->promotional_price_duration = $commercialData->promotional_price_duration;
            $this->portion_size = $commercialData->portion_size;
            $this->ingredients = $commercialData->ingredients;
            $this->spiciness = $commercialData->spiciness;
            $this->price_per_meal = $commercialData->price_per_meal;
            $this->promotional_price_per_meal = $commercialData->promotional_price_per_meal;
            $this->warm_up_instructions = $commercialData->warm_up_instructions;
            $this->comment = $commercialData->comment;
        }
    }
    public function updateRecipe()
    {

        $this->validate();

        try{
            
            if ($this->recipe_image && $this->recipe_image instanceof UploadedFile) {
                $imageName = md5($this->recipe_image . microtime()) . '.' . $this->recipe_image->extension();
                $this->recipe_image->storeAs('public/images', $imageName);

                Recipes::where("id", $this->recipe_id)->update([
                    "recipe_name" => $this->recipe_name,
                    "description" => $this->description,
                    "recipe_image" => $imageName,
                ]);
            } else {
                Recipes::where("id", $this->recipe_id)->update([
                    "recipe_name" => $this->recipe_name,
                    "description" => $this->description
                ]);
            }

            $recipe = Recipes::find($this->recipe_id);

            $commercialData = $recipe->commercialData;
            $commercialData->promotional_price_duration = $this->promotional_price_duration;
            $commercialData->portion_size = $this->portion_size;
            $commercialData->ingredients = $this->ingredients;
            $commercialData->spiciness = $this->spiciness;
            $commercialData->price_per_meal = $this->price_per_meal;
            $commercialData->promotional_price_per_meal = $this->promotional_price_per_meal;
            $commercialData->warm_up_instructions = $this->warm_up_instructions;
            $commercialData->comment = $this->comment;
            $commercialData->save();

            $selectedAllergens = array_filter($this->allergens);
            $recipe->allergens()->sync(array_keys($selectedAllergens));

            $selectedTypes = array_filter($this->types);
            $recipe->types()->sync(array_keys($selectedTypes));

            $recipe->hashtags()->detach();

            // Attach new hashtags
            $hashtags = explode(',', $this->hastag_name);

            foreach ($hashtags as $hashtag) {
                $hashtagModel = Hastags::firstOrCreate(['hastag_name' => $hashtag]);
                $recipe->hashtags()->attach($hashtagModel);
            }

            $this->dispatchBrowserEvent("close-modal", ["modalId" => "editRecipe-Modal"]);
            $this->dispatchBrowserEvent("success", ['message' => 'Рецептот е ажуриран!']);
            $this->recipes = $this->fetchRecipes();
        }catch(Exception $e){
            $this->dispatchBrowserEvent("close-modal", ["modalId" => "editRecipe-Modal"]);
            $this->dispatchBrowserEvent("error", ['message' => 'Грешка при ажурирањето!']);
        }
        
    }

    public function setRecipeId($recipeId)
    {
        $this->recipe_id = $recipeId;
    }


    public function addAvailability()
    {
        $this->validate([
            "date_available_from" => "required|date|after_or_equal:today",
            "date_available_to" => "required|date|after_or_equal:today",
            "serving_numbers" => "required|integer|min:1"
        ]);
        

        try{
            $recipe = Recipes::findOrFail($this->recipe_id);

            // set recipe_availability to 0 for the old availability
            if($recipe->availability_id) {
                $old_availability = Availability::findOrFail($recipe->availability_id);
                $old_availability->recipe_availability = 0;
                $old_availability->save();
            }

            $availability = new Availability();
            $availability->date_available_from = $this->date_available_from;
            $availability->date_available_to = $this->date_available_to;
            $availability->serving_numbers = $this->serving_numbers;
            $availability->recipe_availability = 1;
            $availability->save();

            $recipe->availability_id = $availability->id;
            $recipe->save();

            $this->dispatchBrowserEvent("close-modal", ["modalId" => "availability-Modal"]);
            $this->dispatchBrowserEvent("success", ['message' => 'Достапноста е додадена!']);
            $this->recipes = $this->fetchRecipes();
        }catch(Exception $e){
            $this->dispatchBrowserEvent("error", ['message' => 'Грешка при додавање на достапност!']);
        }
    }

    public function fetchOrders()
    {
        $userId = Auth::id();

        $orders = DB::table('carts')
            ->join('recipes', 'carts.recipe_id', '=', 'recipes.id')
            ->join('users as cooks', 'carts.cook_id', '=', 'cooks.id')
            ->join('users as gourmets', 'carts.gourmet_id', '=', 'gourmets.id')
            ->where('carts.cook_id', '=', $userId)
            ->select('carts.*', 'recipes.recipe_name', 'gourmets.name AS gourmet_name', 'gourmets.lastname AS gourmet_lastname')
            ->orderBy('ordered_at', 'desc')
            ->get();

        return view('dashboard', compact("orders"));
    }
}
