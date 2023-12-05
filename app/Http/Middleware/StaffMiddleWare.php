<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaffMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem người dùng có đăng nhập và thuộc nhóm "Staff" không
        if (auth()->guard('staff')->check()) {
            
            return $next($request);
        }

        // Nếu không, chuyển họ về trang không được phép
        return redirect()->route('admin.accounts.signin');
    }
}
