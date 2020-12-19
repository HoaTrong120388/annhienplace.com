<?php

namespace App\Http\Middleware;

use Closure, Session;
use Illuminate\Http\Request;

class CheckPermissionAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(empty(session('user_group')) || session('user_group') < 3){
            $request->session()->put('error_login', 'Bạn không có quyền vào page này.');
            $request->session()->forget('url_back');
            return redirect()->route("admin.login");
        }
        return $next($request);
    }

}
