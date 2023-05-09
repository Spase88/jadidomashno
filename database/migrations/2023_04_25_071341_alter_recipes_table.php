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
        Schema::table("recipes", function(Blueprint $table){
            $table->bigInteger("commercial_data_id")->unsigned()->nullable()->after("recipe_image");
            $table->foreign("commercial_data_id")->references("id")->on("commercial_data");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
