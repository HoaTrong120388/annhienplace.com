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
    public function detailPost(Request $request)
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
    public function detailCatalog(Request $request)
    {
        $slug = isset($request->slug)?$request->slug:'';
        $slug = FCommon::clearStr($slug);

        if(empty($slug)) return \abort(404);

        $redirect_lang = '';
        if($slug == 'tin-tuc'){
            return view('frontend/content/list/news');
        }elseif($slug == 'shops'){
            return view('frontend/content/list/shops');
        }
        $arrResult = Catalog::where('slug', $slug)->firstOrfail();
        // dd($arrResult);

        if(!$arrResult) return \abort(404);

        if($arrResult->language != $this->lang){
            setcookie('language', $arrResult->language, time() + (86400 * 30), "/");
            return redirect()->route('frontend.catalog.detail', $slug);
        }

        if($arrResult->language != $this->lang){
            setcookie('language', $arrResult->language, time() + (86400 * 30), "/");
            return redirect()->route('frontend.post.detail', $slug);
        }

        $breadcrumb = '';
        $info_seo = json_decode($arrResult->seo);

        $breadcrumb = array(
            array(
                'title' => trans('common.breadcrumb_home'),
                'link'  => route('frontend.home')
            ),
            array(
                'title' => $arrResult->title,
            )
        );

        $id_lang_other = Translation::_get_id($this->lang_next, $this->lang, $arrResult->id, 2);
        $arrResult_other = Catalog::find($id_lang_other);
        if($arrResult_other){
            $redirect_lang =  route("frontend.catalog.detail", $arrResult_other->slug);
        }else{
            $redirect_lang = route('frontend.home');
        }


        $lstPost = Post::_post_in_catalog($arrResult->id, $limit = 20);
        $collection = collect($lstPost);
        $lstNews = $collection->map(function ($item, $key) {
            $item->summary = FCommon::clearStr($item->summary);
            return $item;
        });
        $lstNews->all();
        // FCommon::debug($lstPost, true);
        $arrResult = FCommon::json_decode_object($arrResult, array('more_info', 'seo'));
        if(!isset($arrResult['more_info']->template)){
            $more_info = array('template' => 1);
            $arrResult['more_info'] = (object)$more_info;
        }

        $data = array(
            'titlePage_Seo'             => $info_seo->title,
            'descriptionPage_Seo'       => $info_seo->description,
            'imagePage_Seo'             => $info_seo->image,

            'arrResult'                 => $arrResult,
            'redirect_lang'             => $redirect_lang,
            'breadcrumb'                => $breadcrumb,
            'lstNews'                   => $lstNews,
            'route_news'                => 'frontend.post.detail'
        );
        // if($arrResult['group'] == 3) $data['route_news'] = "frontend.studyabroad.$this->lang.detail";
        return view('frontend/content/list/list')->with($data);
    }
    public function aboutUs(Request $request)
    {
        $arrResult = Page::_detail_about_us($this->lang);
        if(!$arrResult) return \abort(404);
        $redirect_lang = ($this->lang == 'en')?'gioi-thieu-cong-ty.html':'profile.html';

        $arrResult = FCommon::json_decode_object($arrResult, array('more_info', 'seo'));

        $breadcrumb = array(
            array(
                'title' => trans('common.breadcrumb_home'),
                'link'  => route('frontend.home')
            ),
            array(
                'title' => trans('common._content_about_us'),
            )
        );
        $data = array(
            'titlePage_Seo'             => $arrResult['seo']->title,
            'descriptionPage_Seo'       => $arrResult['seo']->description,
            'imagePage_Seo'             => $arrResult['seo']->image,

            'arrResult'                 => $arrResult,
            'redirect_lang'             => $redirect_lang,
            'breadcrumb'                => $breadcrumb,
            'page_about'                => 1,
        );
        return view('frontend/content/detail/articles')->with($data);
    }
    public function viewer(Request $request)
    {
        return view('plugin/viewer');
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
    public function detailLanding(Request $request)
    {
        $slugCatalog = isset($request->slugCatalog)     ?$request->slugCatalog:'';
        $slugDetail = isset($request->slugDetail)     ?$request->slugDetail:'';

        $slugCatalog = FCommon::ClearStr($slugCatalog);
        $slugDetail = FCommon::ClearStr($slugDetail);

        $arrResult = Post::where('slug', $slugDetail)->firstOrFail();
        if($arrResult){
            $arrResult->seo = json_decode($arrResult->seo);
            $arrResult->more_info = json_decode($arrResult->option->more_info);
            $arrResult->template = json_decode($arrResult->option->more_info)->template;
            $arrResult->public_date = Carbon::parse($arrResult->public_date)->format('d-m-Y');
        }
        // dd($arrResult);
        $data = array(
            'titlePage_Seo'         => $arrResult->seo->title,
            'descriptionPage_Seo'   => $arrResult->seo->description,
            'keywordPage_Seo'       => $arrResult->seo->keyword,

            'path_public_landingpage'           => 'public/frontend/landingpage/coming-soon',
            'arrResult'                         => $arrResult

        );
        return view('frontend/content/detail/post1')->with($data);
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
}
