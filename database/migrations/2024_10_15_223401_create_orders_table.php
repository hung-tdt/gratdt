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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade'); // Liên kết đến bảng users
            $table->string('order_number')->unique(); // Mã đơn hàng
            $table->integer('total_amount'); // Tổng số tiền
            $table->string('status')->default('pending'); // Trạng thái đơn hàng
            $table->text('shipping_address'); // Địa chỉ giao hàng
            $table->text('billing_address')->nullable(); // Địa chỉ thanh toán
            $table->string('payment_method')->nullable(); // Phương thức thanh toán
            $table->string('payment_status')->default('unpaid'); // Trạng thái thanh toán
            $table->timestamp('order_date')->useCurrent(); // Ngày đặt hàng
            $table->timestamp('shipping_date')->nullable(); // Ngày giao hàng
            $table->timestamp('delivered_date')->nullable(); // Ngày giao hàng thành công
            $table->text('notes')->nullable(); // Ghi chú của khách hàng
            $table->timestamps(); // Ngày tạo và cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
