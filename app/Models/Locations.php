<?php

namespace App\Models;

use App\Models\User;
use App\Models\Location_cooks;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Locations extends Model
{
    use HasFactory;

    protected $table = 'locations';

    protected $fillable = [
        "user_id",
        "address",
        "municipality"
    ];
}
