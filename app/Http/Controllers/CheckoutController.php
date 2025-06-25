<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Import DB Facade để sử dụng Transaction

// Import các model cần thiết
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

// Import package giỏ hàng (giả sử bạn dùng darryldecode/cart)
use Cart;

class CheckoutController extends Controller
{
    // ... các hàm khác như index() ...

     public function index()
    {
        $cartItems = Cart::getContent();
        
        // Nếu giỏ hàng trống, chuyển hướng
        if ($cartItems->isEmpty()) {
            return redirect()->route('products.index')->with('info', 'Giỏ hàng của bạn đang trống!');
        }

        // TÍNH TOÁN TỔNG TIỀN
        $total = Cart::getTotal();

        // TRUYỀN CẢ 2 BIẾN SANG VIEW
        return view('checkout.index', compact('cartItems', 'total'));
    }


    /**
     * Xử lý việc lưu đơn hàng sau khi người dùng nhấn nút đặt hàng.
     */
    

    public function store(Request $request)
    {
        // 1. Validate dữ liệu đầu vào từ form
        $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_email' => 'required|email|max:255',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:255',
        ]);

        // Kiểm tra xem giỏ hàng có rỗng không
        if (Cart::isEmpty()) {
            return redirect()->route('home')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        // Sử dụng DB Transaction để đảm bảo tính toàn vẹn dữ liệu
        // Nếu có lỗi ở bất kỳ đâu, toàn bộ thao tác sẽ được rollback (hoàn tác)
        DB::beginTransaction();

        try {
            // 2. Tạo bản ghi trong bảng `orders`
            $order = Order::create([
                'user_id' => Auth::id(), // null nếu là khách
                'total' => Cart::getTotal(),
                'status' => 'pending',
                'shipping_name' => $request->shipping_name,
                'shipping_email' => $request->shipping_email,
                'shipping_phone' => $request->shipping_phone,
                'shipping_address' => $request->shipping_address,
            ]);

            // 3. Lặp qua các sản phẩm trong giỏ hàng để tạo bản ghi trong `order_items`
            foreach (Cart::getContent() as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);

                // (Tùy chọn nâng cao) Trừ số lượng tồn kho
                $product = Product::find($item->id);
                if ($product) {
                    $product->decrement('stock', $item->quantity);
                }
            }

            // Nếu mọi thứ thành công, commit transaction
            DB::commit();

            // 4. Xóa giỏ hàng
            Cart::clear();

            // 5. Chuyển hướng đến trang cảm ơn
            // Hãy chắc chắn bạn đã có route và view cho 'thankyou'
            return redirect()->route('thankyou')->with('success', 'Đặt hàng thành công! Cảm ơn bạn đã mua sắm.');

        } catch (\Exception $e) {
            // Nếu có lỗi, rollback lại tất cả các thay đổi trong CSDL
            DB::rollBack();

            // In ra lỗi để debug và quay lại trang trước đó với thông báo lỗi
            // BẠN SẼ THẤY LỖI CHI TIẾT KHI ĐẶT HÀNG LẠI
            dd($e->getMessage()); 
            
            return back()->with('error', 'Đã có lỗi xảy ra trong quá trình đặt hàng. Vui lòng thử lại. Lỗi: ' . $e->getMessage())->withInput();
        }
    }
}