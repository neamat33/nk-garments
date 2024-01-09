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
        Schema::create('tp_production_sends', function (Blueprint $table) {
            $table->id();
            $table->integer('department_id');
            $table->integer('party_id');
            $table->string('company_address')->nullable();
            $table->string('transport_detail');
            $table->date('date');
            $table->string('note')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tp_production_sends');
    }
};
