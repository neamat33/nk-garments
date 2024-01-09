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
        Schema::create('sale_returns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreignId('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->string('customer_name')->nullable();
            $table->text('customer_address')->nullable();
            $table->string('phone')->nullable();
            $table->string('sale_type')->nullable();
            $table->date('sale_date')->nullable();
            $table->dateTime('return_date')->nullable();
            $table->integer('return_qty')->default(0);
            $table->decimal('return_discount', 10, 2)->nullable();
            $table->decimal('return_commission', 10, 2)->nullable();
            $table->decimal('return_amount', 12, 2)->default(0);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_returns');
    }
};
