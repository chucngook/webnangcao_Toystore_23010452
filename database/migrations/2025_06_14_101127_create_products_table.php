<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên sản phẩm
            $table->string('slug')->unique(); // URL thân thiện
            $table->text('description')->nullable(); // Mô tả chi tiết
            $table->decimal('price', 10, 2); // Giá sản phẩm, ví dụ: 125000.50
            $table->integer('stock')->default(0); // Số lượng tồn kho
            $table->string('image')->nullable(); // Đường dẫn tới file ảnh

            // Đây là khóa ngoại liên kết với bảng 'categories'
            $table->foreignId('category_id')
                  ->constrained('categories') // Ràng buộc với bảng 'categories'
                  ->onDelete('cascade'); // Nếu xóa danh mục thì xóa luôn các sản phẩm thuộc danh mục đó

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};