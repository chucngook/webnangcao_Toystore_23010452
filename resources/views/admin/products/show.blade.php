<x-app-layout>
    <div class="bg-white">
        <div class="pt-6 pb-16 sm:pb-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-2 lg:gap-x-8">
                    <!-- Cột bên trái: Ảnh sản phẩm -->
                    <div class="aspect-w-4 aspect-h-5 sm:rounded-lg sm:overflow-hidden lg:aspect-w-3 lg:aspect-h-4">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/600x750?text=No+Image' }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover">
                    </div>

                    <!-- Cột bên phải: Thông tin sản phẩm -->
                    <div class="mt-10 lg:mt-0 lg:col-start-2 lg:row-span-2 lg:self-start">
                        <div class="flex justify-between">
                            <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $product->name }}</h1>
                        </div>

                        <div class="mt-4">
                            <p class="text-3xl tracking-tight text-gray-900">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                        </div>

                        <div class="mt-6">
                            <h3 class="sr-only">Mô tả</h3>
                            <div class="text-base text-gray-700 space-y-6">
                                <p>{{ $product->description }}</p>
                            </div>
                        </div>

                        <section aria-labelledby="details-heading" class="mt-10">
                            <div class="divide-y divide-gray-200 border-t">
                                <!-- Danh mục -->
                                <div class="py-6">
                                    <h3 class="text-sm font-medium text-gray-900">Danh mục</h3>
                                    <div class="mt-2">
                                        <a href="#" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 hover:bg-indigo-200">
                                            {{ $product->category->name }}
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Tồn kho -->
                                <div class="py-6">
                                     <h3 class="text-sm font-medium text-gray-900">Tồn kho</h3>
                                    <div class="mt-2">
                                        <p class="text-base text-gray-700">
                                            @if($product->stock > 0)
                                                Còn hàng ({{ $product->stock }} sản phẩm)
                                            @else
                                                <span class="text-red-600">Hết hàng</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Form thêm vào giỏ hàng -->
                        <form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $product->id }}">
    <input type="hidden" name="name" value="{{ $product->name }}">
    <input type="hidden" name="price" value="{{ $product->price }}">
    <input type="hidden" name="quantity" value="1">
    <button type="submit" ...>Thêm vào giỏ hàng</button>
</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>