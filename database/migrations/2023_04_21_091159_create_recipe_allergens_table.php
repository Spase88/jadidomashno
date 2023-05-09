<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recipe_allergens', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("recipe_id")->unsigned()->nullable();
            $table->foreign("recipe_id")->references("id")->on("recipes");

            $table->bigInteger("allergen_id")->unsigned()->nullable();
            $table->foreign("allergen_id")->references("id")->on("allergens");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_allergens');
    }
};
