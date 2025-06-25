<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // 1. Import model Category
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy 8 sản phẩm mới nhất
        $latestProducts = Product::with('category')->latest()->take(10)->get();
        
        // 2. Lấy tất cả danh mục và đếm số sản phẩm trong mỗi danh mục
        $categories = Category::withCount('products')->get();

        // 3. Truyền cả $categories và $latestProducts ra view
        return view('home', compact('latestProducts', 'categories'));
    }
}