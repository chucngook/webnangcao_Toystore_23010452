<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Import DB Facade
use Illuminate\Support\Facades\Hash; // Import Hash Facade
use App\Models\User; // Import User Model

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sử dụng User Model và Eloquent để tạo, cách này sẽ tự động xử lý timestamps
        // và kích hoạt các model event (nếu có).

        // 1. Tạo tài khoản Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(), // Xác thực email ngay lập tức
            'password' => 'password', // Mật khẩu là 'password'
            'is_admin' => true, // Đặt quyền admin
        ]);

        // 2. Tạo tài khoản User thường
        User::create([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => 'password', // Mật khẩu cũng là 'password'
            'is_admin' => false, // Không phải admin
        ]);

        // (Tùy chọn) Tạo thêm nhiều user thường bằng factory
        // User::factory(10)->create();
    }
}