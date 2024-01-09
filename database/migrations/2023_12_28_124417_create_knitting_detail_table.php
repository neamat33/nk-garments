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
        Schema::create('knitting_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('knitting_id');
            $table->integer('item_id');
            $table->integer('item_variation_id')->nullable(); 
            $table->decimal('qty');
            $table->decimal('weight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('knitting_detail');
    }
};
