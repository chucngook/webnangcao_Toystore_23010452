<x-app-layout>
    {{-- Hero Banner Section --}}
    <div class="w-full bg-gray-100 dark:bg-gray-800 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="swiper mySwiper rounded-xl overflow-hidden shadow-2xl">
                <div class="swiper-wrapper">
                    {{-- Thay thế bằng ảnh của bạn trong thư mục public/images --}}
                    <div class="swiper-slide"><img src="{{ asset('anh1.png') }}" alt="Banner 1" class="w-full h-auto object-cover"></div>
                    <div class="swiper-slide"><img src="{{ asset('anh2.png') }}" alt="Banner 2" class="w-full h-auto object-cover"></div>
                </div>
                {{-- Các nút điều hướng của Slider --}}
                <div class="swiper-button-next text-white"></div>
                <div class="swiper-button-prev text-white"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    {{-- Phần nội dung chính với Sidebar và Sản phẩm mới nhất --}}
    <div class="bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-4 lg:gap-x-8">
                {{-- Cột 1: Sidebar Danh mục --}}
                <aside class="hidden lg:block">
                    <h3 class="text-xl font-bold text-red-600 dark:text-red-500 border-b border-gray-200 dark:border-gray-700 pb-4">Danh Mục</h3>
                    <ul class="mt-4 space-y-4">
                        <li>
                             <a href="{{ route('products.index') }}" class="flex justify-between items-center text-gray-700 dark:text-gray-200 hover:text-red-600 font-semibold">
                                <span>Tất cả sản phẩm</span>
                            </a>
                        </li>
                        {{-- Lặp qua các danh mục được truyền từ Controller --}}
                        @if(isset($categories))
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('categories.show', $category->slug) }}" class="flex justify-between items-center text-gray-600 dark:text-gray-300 hover:text-red-600">
                                        <span>{{ $category->name }}</span>
                                        <span class="text-sm text-gray-400">({{ $category->products_count }})</span>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </aside>

                {{-- Cột 2: Sản phẩm mới nhất --}}
                <main class="lg:col-span-3 mt-10 lg:mt-0">
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-100 mb-6">Sản phẩm mới nhất</h2>
                    
                    <div class="grid grid-cols-2 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-4">
                        @if(isset($latestProducts))
                            @forelse ($latestProducts as $product)
                                <div class="group relative flex flex-col transition duration-300 transform hover:scale-105 hover:shadow-2xl rounded-lg p-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                                    @if($product->is_new)
                                        <span class="absolute top-2 left-2 z-10 inline-flex items-center px-3 py-1 text-xs font-bold leading-4 text-white bg-red-600 rounded-md">MỚI</span>
                                    @endif
                                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200">
                                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-image.png') }}" alt="{{ $product->name }}" class="h-full w-full object-cover object-center group-hover:opacity-80 transition-opacity">
                                    </div>
                                    <div class="mt-4 flex flex-col flex-1">
                                        <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            <a href="{{ route('products.show', $product->slug) }}"><span aria-hidden="true" class="absolute inset-0"></span>{{ $product->name }}</a>
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 flex-1">{{ $product->category->name }}</p>
                                        <p class="mt-2 text-lg font-semibold text-red-600">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                                    </div>
                                </div>
                            @empty
                                 <p class="col-span-full text-center text-gray-500">Chưa có sản phẩm nào.</p>
                            @endforelse
                        @endif
                    </div>
                </main>
            </div>
        </div>
    </div>



    {{-- Script để khởi tạo Swiper --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var swiper = new Swiper(".mySwiper", {
                effect: 'fade',
                loop: true,
                autoplay: { delay: 4000, disableOnInteraction: false },
                navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
                pagination: { el: ".swiper-pagination", clickable: true },
            });
        });
    </script>
</x-app-layout>