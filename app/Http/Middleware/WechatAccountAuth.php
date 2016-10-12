<?php

namespace App\Http\Middleware;

use Closure;

class WechatAccountAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('wechat_account_id') || !$request->session()->has('wechat_meeting_id')) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
