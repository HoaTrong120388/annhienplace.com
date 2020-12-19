<?php

namespace App\Http\Middleware;

use Closure, Session;
use Illuminate\Http\Request;

class CheckPermissions
{
    public function handle(Request $request, Closure $next)
    {
        $routeArray = app('request')->route()->getAction();
        $routername = $routeArray['as'];

        $lst_Permissions_action = session('lst_Permissions_action');
        if(session('user_group') == 10001) return $next($request);
        if(empty($routername) || !in_array($routername, $lst_Permissions_action)){
            $request->session()->flush();
            $request->session()->put('error_login', 'Bạn không có quyền vào page này.');
            flash('Bạn không có quyền truy cập vào đây')->error();
            return redirect()->route("admin.login");
        }
        return $next($request);
    }

}
