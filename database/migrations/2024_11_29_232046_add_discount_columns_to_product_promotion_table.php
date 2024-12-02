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
        Schema::table('product_promotion', function (Blueprint $table) {
            $table->decimal('discount_price', 10, 2)->nullable()->after('promotion_id'); 
            $table->decimal('discount_percentage', 5, 2)->nullable()->after('discount_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_promotion', function (Blueprint $table) {
            $table->dropColumn(['discount_price', 'discount_percentage']);
        });
    }
};
