<?php

namespace App\Http\Middleware;

use Closure, Session;
use Illuminate\Http\Request;

class CheckLogin
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
        if(empty(session('user_id'))){
            if($request->path() != 'admin')
                $request->session()->put('url_back', $request->path());
            $request->session()->put('error_login', 'Bạn chưa đăng nhập. Vui lòng đăng nhập để thực hiện chức năng khác.');
            
            return redirect()->route("admin.login");
        }
        return $next($request);
    }
}
