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
        Schema::create('purchase_returns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreignId('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
            $table->foreignId('party_id')->nullable()->references('id')->on('parties')->onDelete('cascade');
            $table->date('purchase_date')->nullable();
            $table->date('return_date')->nullable();
            //Petty Purchase
            $table->string('purchase_form')->nullable();
            $table->string('order_by_department')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('delivery_to')->nullable();

            $table->string('purchase_type')->nullable();
            $table->integer('return_qty')->default(0);
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
        Schema::dropIfExists('purchase_returns');
    }
};
