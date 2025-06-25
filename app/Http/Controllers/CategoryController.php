<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Hiển thị sản phẩm của một danh mục cụ thể.
     */
    public function show(Category $category)
    {
        // Lấy tất cả danh mục để hiển thị sidebar (giống hệt ProductController@index)
        $categories = Category::withCount('products')->get();
        
        // Lấy các sản phẩm CHỈ thuộc về danh mục đã chọn
        $products = $category->products()->latest()->paginate(12);

        // Trả về cùng một view 'products.index' nhưng với dữ liệu đã được lọc
        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $category, // Truyền thêm danh mục đang được chọn để hiển thị tiêu đề
        ]);
    }
}