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
        Schema::create('commercial_data', function (Blueprint $table) {
            $table->id();
            $table->float('price_per_meal');
            $table->float('promotional_price_per_meal')->nullable();
            $table->date('promotional_price_duration')->nullable();
            $table->string('portion_size');
            $table->string('ingredients');
            $table->string('spiciness');
            $table->text('warm_up_instructions')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commercial_data');
    }
};
