<?php

namespace App\Http\Livewire;

use App\Models\Types;
use App\Models\Hastags;
use App\Models\Recipes;
use Livewire\Component;
use App\Models\Allergens;
use App\Models\CommercialData;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;


class RecipesCook extends Component
{
    use WithFileUploads;

    public $recipe_name;
    public $description;
    public $recipe_image;
    public $hastag_name;
    public $allTypes; //fetch the types from the database
    public $types = []; //store the selected types in the array
    public $allAllergens;
    public $allergens = [];
    public $promotional_price_duration;
    public $portion_size;
    public $ingredients;
    public $spiciness;
    public $price_per_meal;
    public $promotional_price_per_meal;
    public $warm_up_instructions;
    public $comment;
    

    protected $rules = [
        'recipe_name' => 'required|regex:/^.*$/|min:2|max:20',
        'description' => 'required|regex:/^.*$/|min:2|max:150',
        "recipe_image" => "required|image|max:1024",
        "hastag_name" => "required|string|regex:/^(?:#[a-zA-Z0-9_\p{Cyrillic}]+)(?:\s*,*\s*#[a-zA-Z0-9_\p{Cyrillic}]+)*$/mu|max:255",
        "types" => "required|array|min:1",
        "allergens" => "required|array|min:1",
        "promotional_price_duration" => "required|date",
        "portion_size" => "required|regex:/^[A-Za-z0-9\x{0400}-\x{04FF}\s.,!?\"\-]+$/u|max:255",
        "ingredients" => "required|regex:/^[A-Za-z0-9\x{0400}-\x{04FF}\s.,!?\"\-]+$/u|max:255",
        "spiciness" => "required|regex:/^[A-Za-z0-9\x{0400}-\x{04FF}\s.,!?\"\-]+$/u|max:255",
        "price_per_meal" => "required|integer|min:1",
        "promotional_price_per_meal" => "required|integer|min:1",
        "warm_up_instructions" => "required|regex:/^[A-Za-z0-9\x{0400}-\x{04FF}\s.,!?\"\-]+$/u",
        "comment" => "required|regex:/^[A-Za-z0-9\x{0400}-\x{04FF}\s.,!?\"\-]+$/u"

    ];
    protected $messages = [

        'recipe_name.required' => 'Полето за :attribute е задолжително.',
        'recipe_name.regex' => 'Полето за :attribute е невалидно.',
        'recipe_name.min' => 'Внесете минимум 2 карактери.',
        'recipe_name.max' => 'Полето за :attribute не смее да биде поголемо од 20 знаци.',

        'description.required' => 'Полето за :attribute е задолжително.',
        'description.regex' => 'Полето за :attribute е невалидно.',
        'description.min' => 'Внесете минимум 2 карактери.',
        'description.max' => 'Полето за :attribute не смее да биде поголемо од 150 знаци.',

        'recipe_image.required' => 'Полето за :attribute е задолжително.',
        'recipe_image.image' => 'Полето мора да биде слика.',
        'recipe_image.max' => 'Полето за :attribute не смее да биде поголемо од 1MB|1024kb.',

        'hastag_name.required' => 'Полето за :attribute е задолжително.',
        'hastag_name.string' => 'Внесете валиден формат.',
        'hastag_name.regex' => 'Пример за валиден хаштаг: #сочно,#домашно,#супа',
        'hastag_name.max' => 'Полето за :attribute не смее да биде поголемо од 255 карактери.',

        'types.required' => 'Полето за :attribute е задолжително.',
        'types.min' => 'Изберете барем 1 :attribute',

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
    ];

    protected $validationAttributes = [
        'recipe_name' => 'име на рецепт',
        "description" => "опис",
        "recipe_image" => "слика",
        "hastag_name" => "хаштаг",
        "types" => "тип на храна",
        "promotional_price_duration" => "времетраење на промотивна цена",
        "portion_size" => "големина на порцијата",
        "ingredients" => "состојќи",
        "spiciness" => "лутина",
        "price_per_meal" => "цена по оброк",
        "promotional_price_per_meal" => "промотивна цена по оброк",
        "warm_up_instructions" => "инструкции за загевање",
        "comment" => "коментар",
    ];


    public function cooksRecipes()
    {
        $allTypes = $this->fetchTypes();
        $allAllergens = $this->fetchAllergens();
        return view("dashboard", compact("allTypes", "allAllergens"));
    }
    public function fetchTypes()
    {
        $types = Types::all();
        return $types;
    }

    public function fetchAllergens()
    {
        $allergens = Allergens::all();
        return $allergens;
    }

    public function storeRecipe()
    {
        $this->resetErrorBag();

        $this->validate();

        $imageName = md5($this->recipe_image . microtime()) . '.' . $this->recipe_image->extension();
        $this->recipe_image->storeAs('public/images', $imageName);
        $userID = Auth::id();

        try {

            $commercialData = new CommercialData();
            $commercialData->price_per_meal = $this->price_per_meal;
            $commercialData->promotional_price_per_meal = $this->promotional_price_per_meal;
            $commercialData->promotional_price_duration = $this->promotional_price_duration;
            $commercialData->portion_size = $this->portion_size;
            $commercialData->ingredients = $this->ingredients;
            $commercialData->spiciness = $this->spiciness;
            $commercialData->warm_up_instructions = $this->warm_up_instructions;
            $commercialData->comment = $this->comment;
            $commercialData->save();
            
            $recipesValues = array(
                "user_id" => $userID,
                "recipe_name" => $this->recipe_name,
                "description" => $this->description,
                "recipe_image" => $imageName,
                "commercial_data_id" => $commercialData->id
            );
            $recipe = Recipes::create($recipesValues);

            $hashtags = explode(',', $this->hastag_name);

            foreach ($hashtags as $hashtag) {
                $hashtagModel = Hastags::firstOrCreate(['hastag_name' => $hashtag]);
                $recipe->hashtags()->attach($hashtagModel);
            }
        
            $recipe->types()->attach(array_keys($this->types));

            $recipe->allergens()->attach(array_keys($this->allergens));

            session()->flash('success', 'Рецептот е додаден!');
        } catch (\Exception $e) {
            session()->flash('error', 'Грешка при додавање на рецептот.');
        }

    }
}
