<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // Kiểm tra xem đây là yêu cầu từ khách hàng hay quản trị viên
            if ($request->is('customer/*')) {
                return route('customer.login');
            }
            return route('login');
        }
    }
}
