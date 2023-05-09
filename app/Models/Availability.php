<?php

namespace App\Models;

use App\Models\Recipes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Availability extends Model
{
    use HasFactory;

    public function recipe()
    {
        return $this->belongsTo(Recipes::class, 'recipe_id');
    }

    protected $fillable = [
        "date_available_from",
        "date_available_from",
        "date_available_from"
    ];
}
