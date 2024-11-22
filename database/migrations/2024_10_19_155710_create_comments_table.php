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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id'); // Khóa ngoại đến bảng posts
            $table->unsignedBigInteger('customer_id'); // Khóa ngoại đến bảng customers
            $table->text('content'); // Nội dung bình luận
            $table->timestamps();

            // Thiết lập khóa ngoại
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
