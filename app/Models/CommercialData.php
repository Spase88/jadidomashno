<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialData extends Model
{
    use HasFactory;

    protected $fillable = [
        "price_per_meal",
        "promotional_price_per_meal",
        "promotional_price_duration",
        "portion_size",
        "ingredients",
        "spiciness",
        "warm_up_instructions",
        "comment"
    ];
}
