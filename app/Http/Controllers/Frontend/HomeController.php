<?php

namespace App\Http\Controllers\Frontend;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use FCommon;
use App\Model\User, App\Model\Post, App\Model\Page, App\Model\Libary, App\Model\Setting, App\Model\Catalog;

class HomeController extends BaseController
{
    protected $time_now;
    protected $lang;
    protected $lang_next;
    public function __construct()
    {
        $this->time_now = Carbon::now();
        $this->lang = isset($_COOKIE['language'])?$_COOKIE['language']:'vi';
        $this->lang_next = ($this->lang == 'en')?'vi':'en';
    }
    public function home()
    {
        // return redirect()->route('frontend.landingpage.comingsoon');
        $home_slider = Libary::select('id', 'title', 'slug', 'thumbnail', 'thumbnail_mobile', 'link', 'summary')->where('status', 1)->where('parent', 1)->orderby('order', 'asc')->orderby('id', 'desc')->limit(5)->get();

        $home_catalog = Catalog::select('id', 'title', 'slug', 'thumbnail', 'banner_home', 'icon')->where('home', 1)->where('status', 1)->where('group', 1)->orderby('order', 'asc')->orderby('id', 'desc')->limit(10)->get();

        $home_product = Post::where('status', 1)->where('group', 1)->orderby('id', 'desc')->limit(6)->get();
        $home_service = Post::where('status', 1)->where('group', 3)->orderby('id', 'desc')->limit(3)->get();
        $home_news = Post::where('status', 1)->where('group', 2)->orderby('id', 'desc')->limit(3)->get();
        // dd($home_slider);

        $data = array(
            'titlePage_Seo'         => trans('common.main_seo_title'),
            'descriptionPage_Seo'   => trans('common.main_seo_description'),
            'keywordPage_Seo'       => trans('common.main_seo_keyword'),
            
            'home_slider'           => $home_slider,
            'home_catalog'          => $home_catalog,
            'home_product'          => $home_product,
            'home_service'          => $home_service,
            'home_news'             => $home_news,
        );
        return view('frontend/home/index')->with($data);
    }
    public function viewer(Request $request)
    {
        return view('plugin/viewer');
    }
}
