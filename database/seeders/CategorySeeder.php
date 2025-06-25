<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category; // Import model Category

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Xóa dữ liệu cũ để tránh trùng lặp
        Category::query()->delete();

        Category::create(['name' => 'Đồ Chơi Lắp Ráp', 'slug' => 'do-choi-lap-rap']);
        Category::create(['name' => 'Văn Phòng Phẩm', 'slug' => 'van-phong-pham']);
        Category::create(['name' => 'Sách & Truyện', 'slug' => 'sach-truyen']);
        Category::create(['name' => 'Đồ Chơi Mô Hình', 'slug' => 'do-choi-mo-hinh']);
    }
}