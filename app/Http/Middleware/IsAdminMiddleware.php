<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Đừng quên import Auth
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem người dùng đã đăng nhập VÀ có phải là admin không
        if (Auth::check() && Auth::user()->is_admin) {
            // Nếu đúng, cho phép request đi tiếp
            return $next($request);
        }

        // Nếu không phải admin, từ chối truy cập
        // abort(403) sẽ hiển thị trang "403 Forbidden"
        abort(403, 'BẠN KHÔNG CÓ QUYỀN TRUY CẬP TRANG NÀY.');
    }
}