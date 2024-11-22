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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); 
            $table->enum('discount_type', ['fixed', 'percent']); 
            $table->decimal('discount_value', 8, 2); 
            $table->integer('max_uses')->nullable(); 
            $table->date('expiry_date')->nullable(); 
            $table->boolean('active')->default(true); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
