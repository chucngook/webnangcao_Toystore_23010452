<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Thông tin đặt hàng</h1>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Cột bên trái: Thông tin giao hàng --}}
                <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4">Thông tin giao hàng</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="customer_name" class="block text-sm font-medium text-gray-700">Họ và tên</label>
                            <input type="text" name="customer_name" id="customer_name" value="{{ auth()->user()->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div>
                            <label for="shipping_phone" class="block text-sm font-medium text-gray-700">Số điện thoại</label>
                            <input type="text" name="shipping_phone" id="shipping_phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div>
                            <label for="shipping_address" class="block text-sm font-medium text-gray-700">Địa chỉ giao hàng</label>
                            <textarea name="shipping_address" id="shipping_address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required></textarea>
                        </div>
                    </div>
                </div>

                {{-- Cột bên phải: Tóm tắt đơn hàng --}}
                <div class="md:col-span-1 bg-gray-50 p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4">Tóm tắt đơn hàng</h2>
                    <div class="space-y-4">
                        @foreach($cartItems as $item)
                            <div class="flex justify-between">
                             {{-- Sửa lại thành cú pháp mảng: $item['name'] và $item['quantity'] --}}
                             <span>{{ $item['name'] }}  x {{ $item['quantity'] }}</span>
        
                                 {{-- Bạn cũng cần sửa lại cách lấy giá, nếu có --}}
                                {{-- Ví dụ: <span>{{ number_format($item['price'] * $item['quantity']) }} đ</span> --}}
                            </div>
                        @endforeach
                        <div class="border-t pt-4 flex justify-between font-bold">
                            <span>Tổng cộng</span>
                            <span>{{ number_format($total, 0, ',', '.') }} đ</span>
                        </div>
                    </div>
                    <button type="submit" class="mt-6 w-full bg-indigo-600 text-white py-3 rounded-md font-semibold hover:bg-indigo-700">Xác nhận đặt hàng</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>