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
        Schema::create('party_sale_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreignId('party_id')->nullable()->references('id')->on('parties')->onDelete('cascade');
            $table->integer('bank_account_id')->nullable();
            $table->date('payment_date')->nullable();
            $table->integer('total_invoice')->nullable();
            $table->decimal('discount_amount', 22, 2)->nullable(); 
            $table->decimal('pay_amount', 22, 2)->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('party_sale_payments');
    }
};
