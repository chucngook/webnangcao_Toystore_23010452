<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl mx-auto text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
            <h2 class="mt-6 text-2xl font-bold text-gray-900">Đặt hàng thành công!</h2>
            <p class="mt-2 text-gray-600">Cảm ơn bạn đã mua sắm. Đơn hàng của bạn <span class="font-semibold text-indigo-600">#{{ $order->id }}</span> đã được ghi nhận và đang được xử lý.</p>
            <p class="mt-1 text-gray-600">Chúng tôi sẽ liên hệ với bạn để xác nhận trong thời gian sớm nhất.</p>
            <div class="mt-8">
                <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                    Tiếp tục mua sắm
                </a>
            </div>
        </div>
    </div>
</x-app-layout>