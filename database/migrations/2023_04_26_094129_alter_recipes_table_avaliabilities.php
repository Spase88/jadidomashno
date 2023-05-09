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
            $table->bigInteger("availability_id")->unsigned()->nullable()->after("commercial_data_id");
            $table->foreign("availability_id")->references("id")->on("availabilities");
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
