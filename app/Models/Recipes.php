<?php

namespace App\Models;

use App\Models\User;
use App\Models\Types;
use App\Models\Hastags;
use App\Models\Allergens;
use App\Models\CommercialData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipes extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function users()
    {
        return $this->belongsTo(User::class, "user_id", "id")->with('location',"cooks");;
    }

    public function hashtags()
    {
        return $this->belongsToMany(Hastags::class, 'recipe_hastags', 'recipe_id', 'hastag_id');
    }
    public function types()
    {
        return $this->belongsToMany(Types::class, 'recipe_types', "recipe_id", "type_id")->select('types.*');
    }

    public function allergens()
    {
        return $this->belongsToMany(Allergens::class, 'recipe_allergens', "recipe_id", "allergen_id")->select('allergens.*');
    }
    public function commercialData()
    {
        return $this->belongsTo(CommercialData::class);
    }
    public function availabilities()
    {
        return $this->hasMany(Availability::class, 'recipe_id');
    }
    public function availability()
    {
        return $this->belongsTo(Availability::class, 'availability_id');
    }
    public function availabiliti()
    {
        return $this->belongsTo(Availability::class, 'availability_id');
    }


    protected $fillable = [
        "user_id",
        "recipe_name",
        "description",
        "recipe_image",
        "commercial_data_id"
    ];
}
