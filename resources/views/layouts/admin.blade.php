<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $header }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Thanh điều hướng chung cho toàn bộ khu vực Admin --}}
            <div class="flex space-x-1 mb-4 p-2 bg-gray-200 rounded-lg">
                <a href="{{ route('admin.products.index') }}" 
                   class="px-4 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.products.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                   Quản lý Sản phẩm
                </a>
                <a href="{{ route('admin.categories.index') }}"
                    class="px-4 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.categories.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                   Quản lý Danh mục
                </a>
                 <a href="{{ route('admin.orders.index') }}" 
                   class="px-4 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.orders.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                   Quản lý Đơn hàng
                </a>
            </div>

            {{-- Nội dung chính của từng trang sẽ được chèn vào đây --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>