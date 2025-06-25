<x-app-layout>
    <div class="bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Giỏ hàng của bạn</h1>
            @if(count($cartItems) > 0)
                <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                    {{-- Cột bên trái: Danh sách sản phẩm trong giỏ --}}
                    <div class="lg:col-span-2">
                        <div class="bg-white shadow rounded-lg">
                            <table class="min-w-full">
                                <thead class="border-b">
                                    <tr>
                                        <th class="text-left py-3 px-4 font-semibold text-sm">Sản phẩm</th>
                                        <th class="text-left py-3 px-4 font-semibold text-sm">Giá</th>
                                        <th class="text-left py-3 px-4 font-semibold text-sm">Số lượng</th>
                                        <th class="text-left py-3 px-4 font-semibold text-sm">Tạm tính</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $rowId => $item)
                                        <tr class="border-b">
                                            <td class="py-4 px-4 flex items-center">
                                                <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : asset('images/no-image.png') }}" alt="{{ $item['name'] }}" class="h-16 w-16 mr-4 object-cover rounded">
                                                <span>{{ $item['name'] }}</span>
                                            </td>
                                            <td class="py-4 px-4">{{ number_format($item['price']) }} đ</td>
                                            <td class="py-4 px-4">
                                                <form action="{{ route('cart.update', $rowId) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" class="w-16 text-center border rounded">
                                                    <button type="submit" class="text-indigo-600 hover:text-indigo-900 text-xs ml-2">Cập nhật</button>
                                                </form>
                                            </td>
                                            <td class="py-4 px-4">{{ number_format($item['price'] * $item['quantity']) }} đ</td>
                                            <td class="py-4 px-4">
                                                <form action="{{ route('cart.remove', $rowId) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- Cột bên phải: Tóm tắt đơn hàng --}}
                    <div class="lg:col-span-1 mt-8 lg:mt-0">
                        <div class="bg-white p-6 shadow rounded-lg">
                            <h2 class="text-lg font-medium text-gray-900">Tóm tắt đơn hàng</h2>
                            <div class="mt-6 space-y-4">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-gray-600">Tổng tiền hàng</p>
                                    <p class="text-sm font-medium text-gray-900">{{ number_format($total) }} đ</p>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-gray-600">Phí vận chuyển</p>
                                    <p class="text-sm font-medium text-gray-900">Miễn phí</p>
                                </div>
                                <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                                    <p class="text-base font-medium text-gray-900">Tổng cộng</p>
                                    <p class="text-base font-medium text-gray-900">{{ number_format($total) }} đ</p>
                                </div>
                            </div>
                           <div class="mt-6">
    <a href="{{ route('checkout.index') }}" 
       class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">
        Tiến hành đặt hàng
    </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center bg-white p-12 shadow rounded-lg">
                    <p class="text-gray-600">Giỏ hàng của bạn đang trống.</p>
                    <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Tiếp tục mua sắm</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>