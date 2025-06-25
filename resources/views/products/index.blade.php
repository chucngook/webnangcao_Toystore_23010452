<x-app-layout>
    <div class="bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            
            {{-- Đã xóa hoặc comment lại khối @if của breadcrumbs --}}
            {{--
            @if(isset($selectedCategory))
                {{ Breadcrumbs::render('categories.show', $selectedCategory) }}
            @else
                {{ Breadcrumbs::render('products.index') }}
            @endif
            --}}

            <div class="lg:grid lg:grid-cols-4 lg:gap-x-8">
                {{-- Sidebar --}}
                <aside class="hidden lg:block">
                    <h3 class="text-xl font-bold text-red-600 border-b pb-4">Danh Mục</h3>
                    <ul class="mt-4 space-y-4">
                        <li>
                            <a href="{{ route('products.index') }}" 
                               class="flex justify-between items-center transition-colors duration-200 
                               {{ !isset($selectedCategory) ? 'text-red-600 font-bold' : 'text-gray-700 dark:text-gray-300 hover:text-red-600' }}">
                                <span>Tất cả sản phẩm</span>
                            </a>
                        </li>

                        @foreach ($categories as $category)
                            @php
                                $isActive = isset($selectedCategory) && $selectedCategory->id == $category->id;
                            @endphp
                            <li>
                                <a href="{{ route('categories.show', $category->slug) }}" 
                                   class="flex justify-between items-center transition-colors duration-200 
                                   {{ $isActive ? 'text-red-600 font-bold' : 'text-gray-600 dark:text-gray-300 hover:text-red-600' }}">
                                    <span>{{ $category->name }}</span>
                                    <span class="text-sm {{ $isActive ? 'font-semibold text-red-500' : 'text-gray-400' }}">
                                        ({{ $category->products_count }})
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </aside>

                {{-- Sản phẩm --}}
                <main class="lg:col-span-3 mt-10 lg:mt-0">
                    <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-6">
                        <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-gray-100">
                            {{ isset($selectedCategory) ? $selectedCategory->name : 'Tất cả sản phẩm' }}
                        </h1>
                    </div>

                    {{-- Lưới sản phẩm --}}
                    <div class="mt-6 grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($products as $product)
                            <div class="group relative flex flex-col transition duration-300 transform hover:scale-105 hover:shadow-2xl rounded-lg p-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                                @if($product->is_new)
                                    <span class="absolute top-2 left-2 z-10 inline-flex items-center px-3 py-1 text-xs font-bold leading-4 text-white bg-red-600 rounded-md">
                                        MỚI
                                    </span>
                                @endif
                                
                                <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-image.png') }}" 
                                         alt="{{ $product->name }}" 
                                         class="h-full w-full object-cover object-center group-hover:opacity-80 transition-opacity">
                                </div>
                                <div class="mt-4 flex flex-col flex-1">
                                    <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                        <a href="{{ route('products.show', $product->slug) }}">
                                            <span aria-hidden="true" class="absolute inset-0"></span>
                                            {{ $product->name }}
                                        </a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $product->category->name }}</p>
                                    <p class="mt-2 text-lg font-semibold text-red-600">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                                </div>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500">Không tìm thấy sản phẩm nào trong danh mục này.</p>
                        @endforelse
                    </div>

                    {{-- Phân trang --}}
                    <div class="mt-10">
                        {{ $products->links() }}
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
