<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergens extends Model
{
    use HasFactory;

    protected $fillable = [
        "allergen_name"
    ];
}
