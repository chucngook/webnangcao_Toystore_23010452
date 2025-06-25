<div class="bg-red-600">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- 1. Logo -->
            <div class="shrink-0">
                <a href="{{ route('home') }}">
                    <img src="https://www.mykingdom.com.vn/cdn/shop/t/148/assets/logo.png?v=179531034238315565511693310022" alt="Chuc'ToyStore" class="h-10 w-auto">
                </a>
            </div>

            <!-- 2. Thanh tìm kiếm -->
            <div class="flex-1 max-w-2xl mx-8">
                <form action="#" method="GET" class="relative"> {{-- Thay # bằng route tìm kiếm của bạn --}}
                    <input type="search" name="query" placeholder="Nhập từ khóa để tìm kiếm..." value="{{ request('query') }}" class="w-full py-3 px-5 rounded-lg border-none focus:ring-2 focus:ring-yellow-400 text-gray-900">
                    <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-4">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                    </button>
                </form>
            </div>

            <!-- 3. Cụm icon người dùng -->
            <div class="hidden sm:flex items-center space-x-6 text-white font-semibold">
                @auth
                    {{-- Khối này chỉ hiển thị khi người dùng ĐÃ ĐĂNG NHẬP --}}

                    @if (Auth::user()->is_admin)
                        {{-- Nếu là Admin --}}
                        <a href="{{ route('admin.products.index') }}" class="flex flex-col items-center hover:text-yellow-300" title="Quản trị">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.096 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            <span class="text-xs mt-1">Quản trị</span>
                        </a>
                    @else
                         {{-- Nếu là User thường --}}
                        <a href="{{ route('dashboard') }}" class="flex flex-col items-center hover:text-yellow-300" title="Tài khoản của bạn">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            <span class="text-xs mt-1">{{ Str::limit(Auth::user()->name, 10) }}</span>
                        </a>
                    @endif
                    
                    {{-- Nút Đăng xuất --}}
                     <form method="POST" action="{{ route('logout') }}" class="flex items-center">
                        @csrf
                        <button type="submit" class="flex flex-col items-center hover:text-yellow-300" title="Đăng xuất">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                            <span class="text-xs mt-1">Đăng xuất</span>
                        </button>
                    </form>
                @else
                    {{-- Khối này chỉ hiển thị cho KHÁCH (chưa đăng nhập) --}}
                    <a href="{{ route('login') }}" class="flex flex-col items-center hover:text-yellow-300">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        <span class="text-xs mt-1">Tài khoản</span>
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="flex flex-col items-center hover:text-yellow-300">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            <span class="text-xs mt-1">Đăng ký</span>
                        </a>
                    @endif
                @endguest

                {{-- Icon Giỏ hàng (luôn hiển thị) --}}
<a href="{{ route('cart.index') }}" class="flex flex-col items-center hover:text-yellow-300 relative" title="Giỏ hàng">
    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
    <span class="text-xs">Giỏ hàng</span>
    
    {{-- Hiển thị số lượng sản phẩm trong giỏ --}}
    @if(session('cart') && count(session('cart')) > 0)
        <span class="absolute -top-2 -right-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">{{ count(session('cart')) }}</span>
    @endif
</a>
            </div>
        </div>
    </div>
</div>