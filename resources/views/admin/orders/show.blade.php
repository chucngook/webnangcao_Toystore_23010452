<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Chi tiết Đơn hàng #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Cột thông tin khách hàng --}}
                <div class="md:col-span-1 bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold border-b pb-2 mb-4">Thông tin khách hàng</h3>
                    <p><strong>Tên:</strong> {{ $order->customer_name }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                    <p><strong>Số điện thoại:</strong> {{ $order->shipping_phone }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</p>
                    <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Trạng thái:</strong> <span class="font-bold">{{ ucfirst($order->status) }}</span></p>
                </div>

                {{-- Cột chi tiết sản phẩm --}}
                <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold border-b pb-2 mb-4">Các sản phẩm đã đặt</h3>
                    <table class="min-w-full">
                        <tbody>
                            @foreach($order->orderItems as $item)
                            <tr class="border-b">
                                <td class="py-2"><img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://via.placeholder.com/50' }}" class="h-16 w-16 rounded object-cover"></td>
                                <td class="py-2 pl-4">
                                    <p class="font-medium">{{ $item->product->name }}</p>
                                    <p class="text-sm text-gray-600">Số lượng: {{ $item->quantity }}</p>
                                </td>
                                <td class="py-2 text-right">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-right mt-4 font-bold text-xl">
                        Tổng cộng: {{ number_format($order->total_amount, 0, ',', '.') }} đ
                    </div>
                </div>
            </div>

            {{-- Nút hành động --}}
            @if($order->status == 'pending')
            <div class="mt-8 flex justify-end space-x-4">
                <form action="{{ route('admin.orders.reject', $order) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-md hover:bg-red-700">Từ chối đơn</button>
                </form>
                <form action="{{ route('admin.orders.accept', $order) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700">Chấp nhận đơn</button>
                </form>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>