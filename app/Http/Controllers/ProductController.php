<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Hiển thị trang danh sách tất cả sản phẩm với phân trang.
     */
    public function index()
    {

        $categories = Category::withCount('products')->get();
        // Lấy tất cả sản phẩm, sắp xếp theo ngày tạo mới nhất và phân trang (12 sản phẩm mỗi trang)
        $products = Product::latest()->paginate(12);

        return view('products.index', compact('products', 'categories'));
    }

    public function edit(Product $product)
{
    dd('Hàm edit đã được gọi', $product); // Thêm dòng này vào

    $categories = Category::all();
    return view('admin.products.edit', compact('product', 'categories'));
}


public function search(Request $request)
{
    $query = $request->input('query');

    // Tìm sản phẩm theo tên hoặc mô tả
    $products = Product::where('name', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->get();

    return view('products.search', compact('products', 'query'));
}

    /**
     * Hiển thị trang chi tiết của một sản phẩm.
     * Laravel tự động inject model Product dựa trên {product:slug} trong route.
     */
    public function show(Product $product)
    {
        // Eager load thông tin danh mục để sử dụng trong view
        $product->load('category');
        
        return view('products.show', compact('product'));
    }
}