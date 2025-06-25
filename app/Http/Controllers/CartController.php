<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Hiển thị trang giỏ hàng.
     */
    public function index()
    {
        // Lấy giỏ hàng từ session
        $cartItems = session()->get('cart', []);
        $total = 0;

        // Tính tổng tiền
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('cart.index', compact('cartItems', 'total'));
    }

    /**
     * Thêm một sản phẩm vào giỏ hàng.
     */
    public function add(Request $request)
    {
        // 1. Validate dữ liệu được gửi từ form
        // Đảm bảo các trường cần thiết tồn tại và đúng định dạng
        $request->validate([
            'id' => 'required|exists:products,id',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
        ]);

        // 2. Lấy dữ liệu đã được validate từ request
        $productId = $request->id;
        $name = $request->name;
        $price = $request->price;
        $quantity = $request->quantity;
        
        // (Tùy chọn) Tìm sản phẩm để lấy thêm thông tin như ảnh
        $product = Product::find($productId);

        // 3. Thêm vào giỏ hàng
        \Cart::add([
            'id' => $productId,
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'attributes' => [
                'image' => $product->image, // Gửi cả ảnh để hiển thị trong giỏ hàng
                'slug' => $product->slug,   // Gửi cả slug để tạo link
            ]
        ]);

        // 4. Chuyển hướng người dùng về trang trước đó với thông báo thành công
        return back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    /**
     * Cập nhật số lượng của một sản phẩm trong giỏ hàng.
     */
    public function update(Request $request, $rowId)
    {
        $cart = session()->get('cart');

        if (isset($cart[$rowId])) {
            // Cập nhật số lượng
            $cart[$rowId]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return back()->with('success', 'Giỏ hàng đã được cập nhật!');
        }

        return back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
    }

    /**
     * Xóa một sản phẩm khỏi giỏ hàng.
     */
    public function remove($rowId)
    {
        $cart = session()->get('cart');

        if (isset($cart[$rowId])) {
            // Xóa sản phẩm khỏi mảng
            unset($cart[$rowId]);
            session()->put('cart', $cart);
            return back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
        }

        return back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
    }
}