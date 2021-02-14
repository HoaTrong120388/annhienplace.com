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
use App\Model\User, App\Model\Post, App\Model\Page, App\Model\Libary, App\Model\Setting;

class LandingpageController extends BaseController
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
    public function comingsoon()
    {
        // dd(1);
        $data = array(
            'titlePage_Seo'         => trans('landingpage.coming-soon-title'),
            'descriptionPage_Seo'   => trans('landingpage.coming-soon-description'),
            'keywordPage_Seo'       => trans('landingpage.coming-soon-keyword'),

            'path_public_landingpage'           => 'public/frontend/landingpage/coming-soon'
        );
        return view('frontend/landingpage/coming-soon/index')->with($data);
    }
}
