![image](https://github.com/user-attachments/assets/0eb0a89f-6ec8-4885-852e-7051cf873f65)<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Dự án Laravel: Quản lý Cửa hàng Đồ chơi & Văn phòng phẩm
Thông tin sinh viên
Họ tên sinh viên: Nguyễn Xuân Chức
Mã SV: 23010452
Giới thiệu Project
Đây là một dự án ứng dụng web được xây dựng bằng Laravel Framework, phục vụ cho việc quản lý một cửa hàng bán đồ chơi và văn phòng phẩm. Dự án bao gồm các chức năng cốt lõi của một hệ thống quản lý nội dung (CMS) và trang thương mại điện tử cơ bản.
Các công nghệ và chức năng chính:
Framework: Laravel 10.x.
Giao diện: Tailwind CSS.
Xác thực & Phân quyền: Sử dụng Laravel Breeze để quản lý đăng ký, đăng nhập. Hệ thống có 2 vai trò rõ rệt:
Admin: Quản lý toàn bộ sản phẩm, danh mục.
User/Guest: Xem sản phẩm, tìm kiếm.
Quản lý Đối tượng (CRUD): Xây dựng đầy đủ chức năng Thêm (Create), Xem (Read), Sửa (Update), Xóa (Delete) cho các đối tượng Sản phẩm (Product) và Danh mục (Category).
Tương tác Cơ sở dữ liệu: Sử dụng Eloquent ORM và Migrations để định nghĩa và tương tác với các bảng dữ liệu.
Bảo mật: Áp dụng các biện pháp bảo mật tiêu chuẩn của Laravel như CSRF Protection, XSS Protection (qua Blade escaping), Data Validation (qua Form Requests), và bảo vệ khỏi SQL Injection (qua Eloquent).
Sơ đồ cấu trúc (Class Diagram)
Sơ đồ thể hiện mối quan hệ giữa các Model chính trong dự án.
Generated mermaid
classDiagram
    class User {
        +id: int
        +name: string
        +email: string
        +is_admin: boolean
    }

    class Category {
        +id: int
        +name: string
        +slug: string
    }

    class Product {
        +id: int
        +name: string
        +slug: string
        +price: decimal
        +stock: int
        +image: string
        +category_id: int
        +isNew(): boolean
    }

    User "1" -- "0..*" Product : (Có thể có quan hệ nếu có Đơn hàng)
    Category "1" -- "0..*" Product : hasMany
    Product "1" -- "1" Category : belongsTo
Use code with caution.
Mermaid
Sơ đồ thuật toán (Activity Diagram)
Thuật toán: Hiển thị sản phẩm theo Danh mục được chọn
Sơ đồ này mô tả luồng hoạt động khi người dùng click vào một danh mục ở sidebar để lọc sản phẩm.
Generated mermaid
graph TD
    A[Bắt đầu] --> B{Người dùng click vào một danh mục};
    B --> C[Request được gửi đến URL<br>/categories/{slug}];
    C --> D[Laravel Route tìm và gọi<br>CategoryController@show];
    D --> E[Controller nhận slug,<br>tìm Category tương ứng trong CSDL];
    E --> F{Tìm thấy Category?};
    F -- Không --> G[Trả về lỗi 404];
    F -- Có --> H[Lấy tất cả sản phẩm<br>thuộc về Category đó (có phân trang)];
    H --> I[Lấy danh sách tất cả<br>các Category để hiển thị sidebar];
    I --> J[Trả về view 'products.index'<br>cùng với biến: $products, $categories, $selectedCategory];
    J --> K[View render ra HTML,<br>tô đậm danh mục được chọn và hiển thị lưới sản phẩm đã lọc];
    K --> L[Kết thúc];
    G --> L;
Use code with caution.
Mermaid
Ảnh chụp màn hình chức năng chính
<details>
<summary><strong>Nhấn vào đây để xem ảnh chụp màn hình</strong></summary>
1. Trang chủ với Slider và Sản phẩm mới
![alt text](URL_ANH_TRANG_CHU_CUA_BAN)
2. Trang danh sách sản phẩm với Sidebar lọc danh mục
![alt text](URL_ANH_TRANG_SAN_PHAM_CUA_BAN)
3. Trang quản lý sản phẩm (Admin)
![alt text](URL_ANH_ADMIN_PRODUCT_INDEX_CUA_BAN)
4. Form Sửa sản phẩm với đầy đủ thông tin (Admin)
![alt text](URL_ANH_ADMIN_PRODUCT_EDIT_CUA_BAN)
5. Trang quản lý danh mục (Admin)
![alt text](URL_ANH_ADMIN_CATEGORY_INDEX_CUA_BAN)
</details>
Code minh họa phần chính
1. Model: Product.php
Mô hình hóa đối tượng Sản phẩm, định nghĩa các trường được phép gán và mối quan hệ belongsTo với Category.
Generated php
// File: app/Models/Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'category_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected function isNew(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at->gt(now()->subDays(7)),
        );
    }
}
Use code with caution.
PHP
2. Controller: Admin/ProductController.php (Hàm update)
Đoạn code thể hiện logic xử lý request cập nhật sản phẩm, bao gồm validate dữ liệu, xử lý upload và xóa file ảnh, cập nhật vào CSDL.
Generated php
// File: app/Http/Controllers/Admin/ProductController.php
public function update(UpdateProductRequest $request, Product $product)
{
    // Lấy dữ liệu đã được validate từ Form Request
    $data = $request->validated();

    // Kiểm tra xem người dùng có tải lên file ảnh mới không
    if ($request->hasFile('image')) {
        // Xóa ảnh cũ nếu nó đã tồn tại
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        // Lưu ảnh mới vào thư mục 'products' và lấy đường dẫn
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    // Cập nhật sản phẩm với dữ liệu mới
    $product->update($data);

    // Chuyển hướng về trang danh sách
    return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công!');
}
Use code with caution.
PHP
3. View: admin/products/_form.blade.php (Partial View)
Đoạn code thể hiện việc tạo một form dùng chung cho cả chức năng Thêm và Sửa. Sử dụng các helper của Blade như @if, @foreach, old() để xử lý lỗi và hiển thị lại dữ liệu cũ.
Generated html
<!-- File: resources/views/admin/products/_form.blade.php -->

{{-- Hiển thị các lỗi validation nếu có --}}
@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        ...
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Cột bên trái --}}
    <div class="space-y-6">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Tên sản phẩm</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}" class="..." required>
        </div>
        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700">Danh mục</label>
            <select name="category_id" id="category_id" class="..." required>
                <option value="">-- Chọn danh mục --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Cột bên phải --}}
    <div class="space-y-6">
        ...
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Ảnh sản phẩm</label>
            <input type="file" name="image" id="image" class="...">
            
            @if(isset($product) && $product->image)
                <div class="mt-4">
                    <p class="text-sm text-gray-500">Ảnh hiện tại:</p>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="...">
                </div>
            @endif
        </div>
    </div>
</div>
