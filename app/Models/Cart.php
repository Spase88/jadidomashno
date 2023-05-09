<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'cook_id', 
        'gourmet_id', 
        'date', 
        'quantity', 
        'delivery_method', 
        'price'
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipes::class);
    }
    
    public function cook()
    {
        return $this->belongsTo(User::class)->where('role_id', '=', 3);
    }
    
    public function gourmet()
    {
        return $this->belongsTo(User::class)->where('role_id', '=', 2);
    }
}
