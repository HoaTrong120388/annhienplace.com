<?php

namespace App\Http\Controllers\Frontend;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;

use FCommon, Str;
use App\Model\User,
App\Model\Tour,
App\Model\LocationTour,
App\Model\Page,
App\Model\Post,
App\Model\Catalog,
App\Model\Translation
;

class ContentController extends BaseController
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
    public function Postdetail(Request $request)
    {
        $slug = isset($request->slug)?$request->slug:'';
        $slug = FCommon::clearStr($slug);


        if(empty($slug)) return \abort(404);

        $isTemplate = 0;
        $redirect_lang = '';
        $arrResult = Page::where('status', 1)->where('slug', $slug)->firstOrfail();

        $breadcrumb = '';
        if(!$arrResult){
            $arrResult = Post::_detail_by_slug($slug, $this->lang);
            // dd($arrResult);
            if(!$arrResult){
                return \abort(404);
            }else{
                if($arrResult->language != $this->lang){
                    setcookie('language', $arrResult->language, time() + (86400 * 30), "/");
                    return redirect()->route('frontend.post.detail', $slug);
                }

                Post::_update_data($arrResult->id, array('view' => $arrResult->view+1));
                // if
                {
                    $breadcrumb = array(
                        array(
                            'title' => trans('common.breadcrumb_home'),
                            'link'  => route('frontend.home')
                        ),
                        array(
                            'title' => urldecode($arrResult->title),
                        ),
                    );
                }

                $id_lang_other = Translation::_get_id($this->lang_next, $this->lang, $arrResult->id, 3);
                $arrResult_other = Post::find($id_lang_other);

                if($arrResult_other){
                    $redirect_lang =  route("frontend.post.detail", $arrResult_other->slug);
                }
                $arrResult = FCommon::json_decode_object($arrResult, array('seo'));
                $more_info = array('template' => $arrResult['template']);
                $arrResult['more_info'] = (object)$more_info;
            }
        }else{
            $arrResult->view = $arrResult->view+1;
            $arrResult->save();
            $group = $arrResult->group;

            $arrResult = FCommon::json_decode_object($arrResult, array('more_info', 'seo'));

        }

        $data = array(
            'titlePage_Seo'         => $arrResult['seo']->title,
            'descriptionPage_Seo'   => $arrResult['seo']->description,
            'keywordPage_Seo'       => $arrResult['seo']->keyword,

            'arrResult'             => $arrResult,
            'breadcrumb'            => $breadcrumb,
        );

        if(!empty($arrResult['seo']->image)) $data['imagePage_Seo'] = $arrResult['seo']->image;
        if(isset($arrResult_Related) && !$arrResult_Related->isEmpty()) $data['arrResult_Related'] = $arrResult_Related;

        // FCommon::debug($arrResult, true);
        return view('frontend/content/detail/articles')->with($data);

    }
    public function Catalogdetail(Request $request)
    {
        $slug = isset($request->slug)?$request->slug:'';
        $slug = FCommon::clearStr($slug);

        if(empty($slug)) return \abort(404);

        $arrResult = Catalog::where('slug', $slug)->firstOrfail();


        $breadcrumb = '';
        $breadcrumb = array(
            array(
                'title' => $arrResult->title,
            )
        );

        if($arrResult->subcategory()->count() > 0){
            $lstResult = Catalog::where('parent', $arrResult->id)
                                    ->where('group', $arrResult->group)
                                    ->where('status', 1)
                                    ->orderByDesc('id', 'desc')
                                    ->get();
            $type = 'catalog';
        }else{
            $lstResult = Post::where(function ($q) use ($arrResult) {
                            $q->where('catalog_id', $arrResult->id)
                                ->orWhere('catalogsub_id', $arrResult->id)
                                ->orWhere('catalogsubsub_id', $arrResult->id);
                        })
                        ->where('group', $arrResult->group)
                        ->where('status', 1)
                        ->orderByDesc('id', 'desc')
                        ->paginate(9);
            $type = 'detail';
        }

        $arrResult = FCommon::json_decode_object($arrResult, array('more_info', 'seo'));
        // dd($arrResult);

        $data = array(
            'titlePage_Seo'             => $arrResult['seo']['title'],
            'descriptionPage_Seo'       => $arrResult['seo']['description'],
            'imagePage_Seo'             => $arrResult['seo']['image'],

            'arrResult'                 => $arrResult,
            'breadcrumb'                => $breadcrumb,
            'lstResult'                 => $lstResult,
        );

        if($arrResult['group'] == 1)
            return view("frontend/content/product/$type")->with($data);
        elseif($arrResult['group'] == 2)
            return view("frontend/content/news/$type")->with($data);
        elseif($arrResult['group'] == 3)
            return view("frontend/content/service/$type")->with($data);
        elseif($arrResult['group'] == 4)
            return view("frontend/content/folder/$type")->with($data);

        return view('frontend/content/list/list')->with($data);
    }

    public function search(Request $request)
    {
        $more_info = array('template' => 2);
        $arrResult = array(
            'title' => trans("common.title_search_page"),
            'more_info' => (object)$more_info
        );

        $keyword = isset($request->keyword)     ?$request->keyword:'';
        $keyword = FCommon::clearStr($keyword);

        $where = array(
            'title'     => str_replace(' ', '%', $keyword),
            'date_from' => '',
            'date_to'   => '',
            'status'    => 1
        );

        // dd($where);
        $lstNews = Post::_list_search(0, 20, $count, 0, $where);
        $breadcrumb = array(
            array(
                'title' => trans('common.breadcrumb_home'),
                'link'  => route('frontend.home')
            ),
            array(
                'title' => $arrResult['title'],
            )
        );
        $redirect_lang =  route("frontend.$this->lang_next.scholarship");

        $data = array(
            'titlePage_Seo'         => trans("common.seo_title_scholarship"),
            'descriptionPage_Seo'   => trans("common.seo_description_scholarship"),

            'arrResult'             => $arrResult,
            'redirect_lang'         => $redirect_lang,
            'breadcrumb'            => $breadcrumb,
            'lstNews'               => $lstNews,
            'route_news'            => 'frontend.post.detail'
        );
        return view('frontend/content/list/list')->with($data);
    }
    public function service(Request $request)
    {
        $data = array(
            'titlePage_Seo'             => '',
            'descriptionPage_Seo'       => '',
            'imagePage_Seo'             => '',
        );
        return view('frontend/content/list/service')->with($data);
    }
    public function news(Request $request)
    {
        $data = array(
            'titlePage_Seo'             => '',
            'descriptionPage_Seo'       => '',
            'imagePage_Seo'             => '',
        );
        return view('frontend/content/list/news')->with($data);
    }
    public function product(Request $request)
    {
        $data = array(
            'titlePage_Seo'             => '',
            'descriptionPage_Seo'       => '',
            'imagePage_Seo'             => '',
        );
        return view('frontend/content/list/shops')->with($data);
    }
    public function productdetail(Request $request)
    {
        $data = array(
            'titlePage_Seo'             => '',
            'descriptionPage_Seo'       => '',
            'imagePage_Seo'             => '',
        );
        return view('frontend/content/detail/product')->with($data);
    }
}
