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
        Schema::create('party_sale_returns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreignId('party_sale_id')->references('id')->on('party_sales')->onDelete('cascade');
            $table->foreignId('party_id')->nullable()->references('id')->on('parties')->onDelete('cascade');
            $table->dateTime('return_date')->nullable();
            $table->integer('total_qty')->default(0);
            $table->decimal('return_item_value', 12, 2);
            $table->decimal('calculated_discount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('party_sale_returns');
    }
};
