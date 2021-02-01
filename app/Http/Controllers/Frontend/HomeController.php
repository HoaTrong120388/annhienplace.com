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
        // dd($home_slider);

        $data = array(
            'titlePage_Seo'         => trans('common.main_seo_title'),
            'descriptionPage_Seo'   => trans('common.main_seo_description'),
            'keywordPage_Seo'       => trans('common.main_seo_keyword'),
            
            'home_slider'           => $home_slider
        );
        return view('frontend/home/index')->with($data);
    }
}
