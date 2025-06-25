{{-- Hiển thị các lỗi validation nếu có --}}
@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Có lỗi xảy ra! Vui lòng kiểm tra lại thông tin.</strong>
        <ul class="mt-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Các trường của form --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Cột bên trái --}}
    <div class="space-y-6">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Tên sản phẩm</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        </div>
        <div>
            <label for="slug" class="block text-sm font-medium text-gray-700">Slug (URL thân thiện)</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $product->slug ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        </div>
        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700">Danh mục</label>
            <select name="category_id" id="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                <option value="">-- Chọn danh mục --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Giá (VNĐ)</label>
            <input type="number" name="price" id="price" step="1000" min="0" value="{{ old('price', $product->price ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        </div>
        <div>
            <label for="stock" class="block text-sm font-medium text-gray-700">Số lượng tồn kho</label>
            <input type="number" name="stock" id="stock" min="0" value="{{ old('stock', $product->stock ?? 0) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        </div>
    </div>

    {{-- Cột bên phải --}}
    <div class="space-y-6">
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
            <textarea name="description" id="description" rows="8" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $product->description ?? '') }}</textarea>
        </div>
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Ảnh sản phẩm</label>
            <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
            
            @if(isset($product) && $product->image)
                <div class="mt-4">
                    <p class="text-sm text-gray-500">Ảnh hiện tại:</p>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-40 w-40 object-cover rounded-md">
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Các nút bấm --}}
<div class="mt-8 pt-5 border-t border-gray-200">
    <div class="flex justify-end">
        <a href="{{ route('admin.products.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
            Hủy
        </a>
        <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
            Lưu
        </button>
    </div>
</div>