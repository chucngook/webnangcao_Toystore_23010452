<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::query()->delete();

        // category_id 1: Đồ Chơi Lắp Ráp
        Product::create(['name' => 'LEGO Technic 42128 Xe Cẩu Hạng Nặng', 'slug' => 'lego-technic-42128', 'description' => 'Mô hình xe cẩu chi tiết với nhiều chức năng khí nén.', 'price' => 4599000, 'stock' => 25, 'category_id' => 1]);
        Product::create(['name' => 'LEGO Creator 31129 Hổ Vương Oai Vệ', 'slug' => 'lego-creator-31129', 'description' => 'Mô hình 3 trong 1: Hổ, Gấu trúc đỏ, và Cá Koi.', 'price' => 1499000, 'stock' => 40, 'category_id' => 1]);

        // category_id 2: Văn Phòng Phẩm
        Product::create(['name' => 'Bộ 24 Bút Màu Nước Stabilo', 'slug' => 'bo-24-but-mau-nuoc-stabilo', 'description' => 'Màu sắc tươi sáng, bền màu, không độc hại.', 'price' => 250000, 'stock' => 150, 'category_id' => 2]);
        Product::create(['name' => 'Sổ Tay Bìa Da Cao Cấp KLONG', 'slug' => 'so-tay-bia-da-klong', 'description' => 'Kích thước A5, giấy kẻ ngang chống lóa.', 'price' => 120000, 'stock' => 300, 'category_id' => 2]);
        Product::create(['name' => 'Hộp 12 Bút Chì Staedtler 2B', 'slug' => 'hop-12-but-chi-staedtler-2b', 'description' => 'Chất lượng cao từ Đức, khó gãy.', 'price' => 65000, 'stock' => 500, 'category_id' => 2]);


        // category_id 3: Sách & Truyện
        Product::create(['name' => 'Harry Potter và Hòn Đá Phù Thủy', 'slug' => 'harry-potter-va-hon-da-phu-thuy', 'description' => 'Tập đầu tiên trong bộ truyện kinh điển của J.K. Rowling.', 'price' => 110000, 'stock' => 120, 'category_id' => 3]);
        Product::create(['name' => 'Nhà Giả Kim - Paulo Coelho', 'slug' => 'nha-gia-kim', 'description' => 'Cuốn sách bán chạy nhất mọi thời đại về ước mơ và định mệnh.', 'price' => 79000, 'stock' => 300, 'category_id' => 3]);

        // category_id 4: Đồ Chơi Mô Hình
        Product::create(['name' => 'Mô hình Xe Lamborghini Sian FKP 37', 'slug' => 'mo-hinh-lamborghini-sian', 'description' => 'Tỷ lệ 1:18, chi tiết tinh xảo.', 'price' => 950000, 'stock' => 15, 'category_id' => 4]);
        Product::create(['name' => 'Mô hình Tàu Thousand Sunny (One Piece)', 'slug' => 'mo-hinh-thousand-sunny', 'description' => 'Mô hình lắp ráp tàu của băng Mũ Rơm.', 'price' => 550000, 'stock' => 45, 'category_id' => 4]);
    }
}