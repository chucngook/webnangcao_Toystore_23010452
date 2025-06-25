<?php 

// Import các class cần thiết ở đầu file
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use App\Models\Category;
use App\Models\Product;

// Breadcrumb cho Trang chủ
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Trang chủ', route('home'));
});

// Breadcrumb cho Trang danh sách sản phẩm
// Home > Sản phẩm
// Đây là định nghĩa đã bị thiếu và gây ra lỗi của bạn
Breadcrumbs::for('products.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Sản phẩm', route('products.index'));
});

// Breadcrumb cho Trang danh sách sản phẩm theo danh mục
// Home > Sản phẩm > [Tên danh mục]
Breadcrumbs::for('categories.show', function (BreadcrumbTrail $trail, Category $category) {
    $trail->parent('products.index');
    $trail->push($category->name, route('categories.show', $category->slug));
});

// Breadcrumb cho Trang chi tiết sản phẩm
// Home > Sản phẩm > [Tên danh mục] > [Tên sản phẩm]
Breadcrumbs::for('products.show', function (BreadcrumbTrail $trail, Product $product) {
    $trail->parent('categories.show', $product->category);
    $trail->push($product->name, route('products.show', $product->slug));
});