<x-app-layout>
    <div class="bg-white dark:bg-gray-800">
        <div class="pt-6 pb-16 sm:pb-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{-- Breadcrumbs (nếu bạn đã cài đặt) --}}
                {{-- {{ Breadcrumbs::render('products.show', $product) }} --}}

                <div class="lg:grid lg:grid-cols-2 lg:gap-x-8">
                    <!-- Cột bên trái: Ảnh sản phẩm -->
                    <div class="aspect-w-4 aspect-h-5 sm:rounded-lg sm:overflow-hidden lg:aspect-w-3 lg:aspect-h-4">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-image.png') }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover">
                    </div>

                    <!-- Cột bên phải: Thông tin sản phẩm -->
                    <div class="mt-10 lg:mt-0 lg:col-start-2 lg:row-span-2 lg:self-start">
                        <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-100">{{ $product->name }}</h1>

                        <div class="mt-4">
                            <p class="text-3xl tracking-tight text-gray-900 dark:text-gray-100">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                        </div>

                        <div class="mt-6">
                            <h3 class="sr-only">Mô tả</h3>
                            <div class="text-base text-gray-700 dark:text-gray-300 space-y-6">
                                <p>{{ $product->description }}</p>
                            </div>
                        </div>

                        <section aria-labelledby="details-heading" class="mt-10">
                            <div class="divide-y divide-gray-200 dark:divide-gray-700 border-t dark:border-gray-700">
                                <!-- Danh mục -->
                                <div class="py-6">
                                    <h3 class="text-sm font-medium text-gray-900 dark:text-gray-200">Danh mục</h3>
                                    <div class="mt-2">
                                        <a href="{{ route('categories.show', $product->category->slug) }}" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 hover:bg-indigo-200">
                                            {{ $product->category->name }}
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Tồn kho -->
                                <div class="py-6">
                                     <h3 class="text-sm font-medium text-gray-900 dark:text-gray-200">Tồn kho</h3>
                                    <div class="mt-2">
                                        <p class="text-base text-gray-700 dark:text-gray-300">
                                            @if($product->stock > 0)
                                                Còn hàng ({{ $product->stock }} sản phẩm)
                                            @else
                                                <span class="text-red-500 font-semibold">Hết hàng</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </section>

                       <!-- Form thêm vào giỏ hàng -->
<!-- Form thêm vào giỏ hàng -->
<form action="{{ route('cart.add') }}" method="POST">
    @csrf

    {{-- 
        Các input ẩn này sẽ gửi thông tin sản phẩm đến CartController.
        Chúng không hiển thị trên giao diện nhưng dữ liệu vẫn được gửi đi.
    --}}
    <input type="hidden" name="id" value="{{ $product->id }}">
    <input type="hidden" name="name" value="{{ $product->name }}">
    <input type="hidden" name="price" value="{{ $product->price }}">
    
    {{-- Mặc định thêm 1 sản phẩm mỗi lần nhấn nút --}}
    <input type="hidden" name="quantity" value="1"> 
    
    {{-- 
        (Tùy chọn) Thêm input để người dùng chọn số lượng 
        <div class="flex items-center">
            <label for="quantity" class="mr-4">Số lượng:</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1" class="w-20 rounded border-gray-300">
        </div>
    --}}

    <div class="mt-10">
        <button type="submit" 
                class="w-full bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50"
                @if($product->stock <= 0) disabled @endif>
            Thêm vào giỏ hàng
        </button>
    </div>
</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>