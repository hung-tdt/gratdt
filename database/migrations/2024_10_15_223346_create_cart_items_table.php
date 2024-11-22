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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->onDelete('cascade'); // Liên kết đến bảng carts
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Liên kết đến bảng products
            $table->integer('quantity'); // Số lượng sản phẩm
            $table->integer('price'); // Giá của sản phẩm
            $table->integer('total'); // Tổng giá trị của sản phẩm trong giỏ hàng
            $table->timestamps(); // Ngày tạo và cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
