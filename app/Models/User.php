<?php

namespace App\Models;


use App\Models\Cooks;
use App\Models\Roles;
use App\Models\Recipes;
use App\Models\Locations;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    public function role()
    {
        return $this->belongsTo(Roles::class);
    }

    public function location()
    {
        return $this->hasOne(Locations::class, 'user_id');
    }

    public function cooks()
    {
        return $this->hasOneThrough(
            Cooks::class, // Target model
            Locations::class, // Intermediate model
            'user_id', // Foreign key on the intermediate model
            'location_id', // Foreign key on the target model
            'id', // Local key on the source model
            'id' // Local key on the intermediate model
        );
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        "lastname",
        "mobile",
        "biography",
        "profile_image",
        "role_id",
        'email',
        'password',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
