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
        Schema::create('party_sale_commission_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreignId('party_sale_commission_id')->nullable()->references('id')->on('party_sale_commissions')->onDelete('cascade');
            $table->foreignId('party_sale_id')->references('id')->on('party_sales')->onDelete('cascade');
            $table->integer('total_qty')->default(0); 
            $table->decimal('commission_per_qty', 10, 2)->nullable();
            $table->decimal('total_commission', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('party_sale_commission_items');
    }
};
