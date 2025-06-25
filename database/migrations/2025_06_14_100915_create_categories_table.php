<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Cột ID, khóa chính, tự động tăng
            $table->string('name'); // Tên danh mục, ví dụ: "Đồ chơi lắp ráp"
            $table->string('slug')->unique(); // Chuỗi URL thân thiện, ví dụ: "do-choi-lap-rap". 'unique' để đảm bảo không trùng.
            $table->text('description')->nullable(); // Mô tả danh mục, 'nullable' cho phép bỏ trống
            $table->timestamps(); // Tự động tạo 2 cột: created_at và updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};