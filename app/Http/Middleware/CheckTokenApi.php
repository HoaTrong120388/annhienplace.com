<?php

namespace App\Http\Middleware;

use Closure, Session, File;
use Illuminate\Http\Request;
use FCommon;

class CheckTokenApi
{
    public function handle(Request $request, Closure $next)
    {
        $cnt_file = File::get('whitelist.txt');
        $white_list_ip = explode("\n", $cnt_file);
        $header_token = $request->header('token');
        $ip = $request->ip();
        if(empty($header_token)){
            return response()->json(array('status'=>0,'msg'=>'author die'));
        }else{
            $token = FCommon::XoaDinhDang($header_token);
            $token_active = '2j3F!*jwn$vfe$LQM=AR!BQ8A7XLb7cynrqyBstXFXx5gu4!dnXd5w*aX=Yz';

            if($token !== $token_active)
                return response()->json(array('status'=>0,'msg'=>'author die'));

            if(!in_array($ip, $white_list_ip))
                return response()->json(array('status'=>0,'msg'=>'page error'));
        }
        return $next($request);
    }

}
