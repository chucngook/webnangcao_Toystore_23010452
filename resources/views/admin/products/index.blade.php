<x-admin-layout>
    {{-- Đặt tiêu đề cho trang, sẽ được hiển thị trong slot 'header' của admin.blade.php --}}
    <x-slot name="header">
        Quản lý Sản phẩm
    </x-slot>

    {{-- Phần nội dung chính, sẽ được hiển thị trong slot chính của admin.blade.php --}}
    
    <!-- Nút Thêm sản phẩm -->
    <div class="mb-4 text-right">
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
            + Thêm sản phẩm
        </a>
    </div>

    <!-- Thông báo thành công -->
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- Bảng danh sách sản phẩm -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ảnh</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tên sản phẩm</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Giá</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tồn kho</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Hành động</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($products as $product)
                    <tr>
                        <td class="px-6 py-4"><img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/50' }}" alt="{{ $product->name }}" class="h-12 w-12 rounded-md object-cover"></td>
                        <td class="px-6 py-4">{{ $product->name }}</td>
                        <td class="px-6 py-4">{{ number_format($product->price, 0, ',', '.') }} đ</td>
                        <td class="px-6 py-4">{{ $product->stock }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-indigo-600 hover:text-indigo-900">Sửa</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Bạn có chắc chắn?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-4 text-center">Không có sản phẩm nào.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Phân trang -->
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</x-admin-layout>