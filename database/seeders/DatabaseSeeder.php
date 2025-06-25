<?php

namespace Database\Seeders;

// Dòng này cần thiết để sử dụng Seeder class
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 *
 * Đây là Seeder "chủ", có nhiệm vụ điều phối và gọi các Seeder con khác.
 * Thứ tự gọi các seeder rất quan trọng để đảm bảo tính toàn vẹn dữ liệu.
 * Ví dụ: Phải tạo Users và Categories trước khi tạo Products,
 * vì Products phụ thuộc vào Users (người tạo) và Categories (danh mục).
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Phương thức này sẽ được thực thi khi bạn chạy lệnh `php artisan db:seed`.
     *
     * @return void
     */
    public function run(): void
    {
        // Sử dụng phương thức call() để thực thi một mảng các class seeder.
        // Laravel sẽ chạy chúng theo thứ tự bạn định nghĩa trong mảng.
        $this->call([
            /**
             * 1. UserSeeder:
             * Tạo tài khoản Admin và các tài khoản người dùng mẫu.
             * Cần chạy trước tiên vì các đối tượng khác có thể liên quan đến người dùng.
             */
            UserSeeder::class,

            /**
             * 2. CategorySeeder:
             * Tạo ra các danh mục sản phẩm mẫu (ví dụ: Đồ chơi, Văn phòng phẩm).
             * Cần chạy trước ProductSeeder vì mỗi sản phẩm phải thuộc về một danh mục.
             */
            CategorySeeder::class,

            /**
             * 3. ProductSeeder:
             * Tạo ra các sản phẩm mẫu. Seeder này sẽ sử dụng các danh mục đã được tạo
             * ở bước trên để gán cho các sản phẩm.
             */
            ProductSeeder::class,
        ]);

        // Bạn cũng có thể thêm lời nhắn ra terminal để biết quá trình seed đã hoàn tất.
        $this->command->info('Database seeded successfully!');
    }
}