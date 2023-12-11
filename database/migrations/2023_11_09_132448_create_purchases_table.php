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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id')->nullable();
            //Party Purchase
            $table->foreignId('party_id')->nullable()->references('id')->on('parties')->onDelete('cascade');
            $table->date('purchase_date')->nullable();
            $table->integer('order_by')->nullable();
            $table->date('delivery_date')->nullable();
            $table->integer('purchase_by')->nullable();

            //Petty Purchase
            $table->string('purchase_form')->nullable();
            $table->string('order_by_department')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('delivery_to')->nullable();

            $table->string('purchase_type');
            $table->text('note')->nullable();
            $table->decimal('payable', 22, 2)->default(0);
            $table->decimal('returned',22,2)->default(0);
            $table->decimal('final_payable', 22, 2)->default(0);
            $table->decimal('paid',22,2)->default(0);
            $table->decimal('due',22,2)->default(0);
            $table->integer('total_qty')->default(0); 
            $table->integer('delivery_qty')->default(0);
            $table->integer('due_qty')->default(0);
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
        Schema::dropIfExists('purchases');
    }
};
