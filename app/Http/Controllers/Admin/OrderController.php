<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Eager load các sản phẩm trong đơn hàng
         $order->load('user', 'items.product');
        return view('admin.orders.show', compact('order'));
    }

    public function accept(Order $order)
    {
        $order->update(['status' => 'processing']);
        return back()->with('success', 'Đã chấp nhận đơn hàng.');
    }

    public function reject(Order $order)
    {
        $order->update(['status' => 'cancelled']);
        // (Nâng cao) Hoàn lại tồn kho ở đây
        return back()->with('success', 'Đã từ chối đơn hàng.');
    }

      public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'string', 'in:pending,processing,shipped,delivered,cancelled'],
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}