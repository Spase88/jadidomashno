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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("recipe_id")->unsigned()->nullable();
            $table->bigInteger("cook_id")->unsigned()->nullable();
            $table->bigInteger("gourmet_id")->unsigned()->nullable();
            $table->date('date');
            $table->integer('quantity');
            $table->boolean('delivery_method')->default(1);
            $table->decimal('price', 10, 2);
            $table->timestamps();

            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->foreign('cook_id')->references('id')->on('users');
            $table->foreign('gourmet_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
