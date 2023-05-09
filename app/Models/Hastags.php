<?php

namespace App\Models;

use App\Models\Recipes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hastags extends Model
{
    use HasFactory;

    protected $fillable = [
        "hastag_name"
    ];

    public function recipes()
    {
        return $this->belongsToMany(Recipes::class, 'recipe_hastags', 'hastag_id', 'recipe_id');
    }
}
