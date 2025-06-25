<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Thêm cột is_admin sau cột email
            // boolean: kiểu dữ liệu true/false (0/1)
            // default(false): giá trị mặc định khi tạo user mới là false (không phải admin)
            $table->boolean('is_admin')->default(false)->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Xóa cột is_admin nếu migration bị rollback
            $table->dropColumn('is_admin');
        });
    }
};