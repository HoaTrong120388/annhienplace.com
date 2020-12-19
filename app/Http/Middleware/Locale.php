<?php
namespace App\Http\Middleware;
use Illuminate\Http\Response;
use Closure, Session, App, FCommon, Config, Cookie;

class Locale {
    public function handle($request, Closure $next)
    {
        // $minutes = 30;
        // response('Hello word')->withCookie(
        //     'name', 'value', $minutes
        // );
        // $name_cookie = cookie('language', 'en', $minutes);
        // Cookie::queue('language', 'en', $minutes);
        // $language = $request->cookie('language');
        // var_dump($language);exit;
        $language = isset($_COOKIE['language'])?$_COOKIE['language']:'vi';
        App::setLocale($language);

        return $next($request);
    }
}
?>