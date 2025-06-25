<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{-- Sử dụng biến $product được truyền từ controller --}}
            {{ __('Chỉnh sửa Sản phẩm: ') . $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Form để cập nhật sản phẩm. Nó sẽ gửi dữ liệu đến hàm update() --}}
                    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Quan trọng: Chỉ định phương thức HTTP là PUT cho việc update --}}
                        
                        {{-- Gọi file form partial chung vào đây. --}}
                        {{-- Laravel sẽ tự động truyền các biến ($product, $categories) vào file partial này --}}
                        @include('admin.products._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>