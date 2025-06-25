<div class="flex space-x-4 p-4 bg-gray-200 dark:bg-gray-700 rounded-md">
    {{-- Link đến trang quản lý sản phẩm --}}
    <a href="{{ route('admin.products.index') }}" 
       class="px-4 py-2 rounded-md text-sm font-medium 
              {{ request()->routeIs('admin.products.*') ? 'bg-blue-600 text-white' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-100' }}">
       Quản lý Sản phẩm
    </a>
    
    {{-- Link đến trang quản lý danh mục --}}
    <a href="{{ route('admin.categories.index') }}"
        class="px-4 py-2 rounded-md text-sm font-medium 
               {{ request()->routeIs('admin.categories.*') ? 'bg-blue-600 text-white' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-100' }}">
       Quản lý Danh mục
    </a>

    <div class="flex space-x-4 p-4 bg-gray-200 rounded-md">
    <a href="{{ route('admin.products.index') }}" class="...">Quản lý Sản phẩm</a>
    <a href="{{ route('admin.categories.index') }}" class="...">Quản lý Danh mục</a>
    {{-- Thêm dòng này --}}
    <a href="{{ route('admin.orders.index') }}" 
       class="px-4 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.orders.*') ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
       Quản lý Đơn hàng
    </a>
</div>

    {{-- THÊM LINK NÀY VÀO --}}
    <a href="{{ route('admin.orders.index') }}"
        class="px-4 py-2 rounded-md text-sm font-medium 
               {{ request()->routeIs('admin.orders.*') ? 'bg-blue-600 text-white' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-100' }}">
       Quản lý Đơn hàng
    </a>
</div>