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
        Schema::create('cooks', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("location_id")->unsigned()->nullable();
            $table->foreign("location_id")->references("id")->on("locations");

            $table->text("pickup_instrucntions");
            $table->text("website_link")->nullable();
            $table->text("facebook_link")->nullable();
            $table->text("instagram_link")->nullable();
            $table->text("other_link")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cooks');
    }
};
