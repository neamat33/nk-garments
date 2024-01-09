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
        Schema::create('party_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->string('showroom')->nullable();
            $table->string('sale_type')->nullable();
            $table->foreignId('party_id')->nullable()->references('id')->on('parties')->onDelete('cascade');
            $table->date('sale_date')->nullable();
            $table->integer('order_by')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('delivery_to')->nullable();
            $table->integer('sold_by')->nullable();
            //return 
            $table->decimal('returned_commission', 22, 2)->default(0);
            $table->decimal('returned_discount', 22, 2)->default(0);
            $table->decimal('returned_amount',22,2)->default(0);
            $table->integer('returned_qty')->default(0);

            $table->decimal('payment_discount', 22, 2)->nullable();
            $table->decimal('total_discount', 22, 2)->nullable();
            $table->decimal('sale_commission', 22, 2)->nullable();
            $table->decimal('add_commission', 22, 2)->nullable();
            $table->decimal('total_commission', 22, 2)->nullable();
            $table->decimal('receivable', 22, 2)->default(0);
            $table->decimal('final_receivable',22,2)->default(0);
            $table->decimal('paid',22,2)->default(0);
            $table->decimal('due',22,2)->default(0);
            $table->integer('total_qty')->default(0); 
            $table->integer('delivery_qty')->default(0);
            $table->integer('due_qty')->default(0);
            $table->text('note')->nullable();
            $table->string('delivery_status')->nullable();
            $table->string('payment_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('party_sales');
    }
};
