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
        $slug = FCommon::XoaDinhDang($slug);

        if(empty($slug)) return \abort(404);

        $isTemplate = 0;
        $redirect_lang = '';
        $arrResult = Page::_detail_by_slug($slug, $this->lang);
        $redirect_lang = route('frontend.home');

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
            if($arrResult->language != $this->lang){
                setcookie('language', $arrResult->language, time() + (86400 * 30), "/");
                return redirect()->route('frontend.post.detail', $slug);
            }
            Page::_edit($arrResult->id, array('view' => $arrResult->view+1));
            $group = $arrResult->group;
            $id_lang_other = Translation::_get_id($this->lang_next, $this->lang, $arrResult->id, 1);
            $arrResult_other = Page::find($id_lang_other);

            $breadcrumb = array(
                array(
                    'title' => trans('common.breadcrumb_home'),
                    'link'  => route('frontend.home')
                ),
                array(
                    'title' => urldecode($arrResult->title)
                )
            );
            if($group == 2){
                if($arrResult_other){
                    $redirect_lang =  route("frontend.studyabroad.$this->lang_next.detail", $arrResult_other->slug);
                }
            }else{
                if($arrResult_other){
                    $redirect_lang =  route("frontend.post.detail", $arrResult_other->slug);
                }
            }
            $arrResult = FCommon::json_decode_object($arrResult, array('more_info', 'seo'));

        }

        $data = array(
            'titlePage_Seo'         => $arrResult['seo']->title,
            'descriptionPage_Seo'   => $arrResult['seo']->description,
            'keywordPage_Seo'       => $arrResult['seo']->keyword,

            'arrResult'             => $arrResult,
            'breadcrumb'            => $breadcrumb,
            'redirect_lang'         => $redirect_lang
        );

        if(!empty($arrResult['seo']->image)) $data['imagePage_Seo'] = $arrResult['seo']->image;
        if(isset($arrResult_Related) && !$arrResult_Related->isEmpty()) $data['arrResult_Related'] = $arrResult_Related;

        // FCommon::debug($arrResult, true);
        return view('frontend/content/detail/articles')->with($data);

    }
    public function detailCatalog(Request $request)
    {
        $slug = isset($request->slug)?$request->slug:'';
        $slug = FCommon::ClearStr($slug);

        if(empty($slug)) return \abort(404);

        $redirect_lang = '';
        $arrResult = Catalog::where('slug', $slug)->where('language', $this->lang)->where('status', 1)->firstOrFail();
        if(!$arrResult) return \abort(404);

        $lstPost = Post::where(function ($q) use ($arrResult) {
                        $q->where('catalog_id', $arrResult->id)->orWhere('catalogsub_id', $arrResult->id);
                    })->where('language', $this->lang)->where('status', 1)->orderBy('public_date', 'desc')->get();
        // dd($lstPost);

        $collection = collect($lstPost);
        $lstNews = $collection->map(function ($item, $key) {
            $item->summary = FCommon::ClearStr($item->summary);
            return $item;
        });
        $lstNews->all();
        $arrResult = FCommon::json_decode_object($arrResult, array('more_info', 'seo'));
        if(!isset($arrResult['more_info']->template)){
            $more_info = array('template' => 1);
            $arrResult['more_info'] = (object)$more_info;
        }
        // dd($arrResult);

        $data = array(
            'titlePage_Seo'             => $arrResult['seo']->title,
            'descriptionPage_Seo'       => $arrResult['seo']->description,
            'imagePage_Seo'             => $arrResult['seo']->image,

            'arrResult'                 => $arrResult,
            'lstNews'                   => $lstNews,
            'route_news'                => 'frontend.post.detail'
        );
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
        $keyword = FCommon::XoaDinhDang($keyword);

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

        $arrResult = Post::where('slug', $slugDetail)->where('language', $this->lang)->where('status', 1)->firstOrFail();

        if($arrResult){
            $arrResult->more_info = $arrResult->option->more_info;
            $arrResult->public_date = Carbon::parse($arrResult->public_date)->format('d-m-Y');
        }
        $arrResult = FCommon::json_decode_object($arrResult, array('more_info', 'seo'));

        $data = array(
            'titlePage_Seo'         => $arrResult['seo']->title,
            'descriptionPage_Seo'   => $arrResult['seo']->description,
            'keywordPage_Seo'       => $arrResult['seo']->keyword,

            'arrResult'                         => $arrResult

        );
        return view('frontend/content/detail/service')->with($data);
    }
    public function detailPage(Request $request)
    {
        $slugDetail = isset($request->slugDetail)     ?$request->slugDetail:'';

        $slugDetail = FCommon::ClearStr($slugDetail);

        $arrResult = Page::where('slug', $slugDetail)->where('language', $this->lang)->where('status', 1)->firstOrFail();

        if($arrResult){
            $arrResult->public_date = Carbon::parse($arrResult->public_date)->format('d-m-Y');
        }
        $arrResult = FCommon::json_decode_object($arrResult, array('more_info', 'seo'));

        $data = array(
            'titlePage_Seo'         => $arrResult['seo']->title,
            'descriptionPage_Seo'   => $arrResult['seo']->description,
            'keywordPage_Seo'       => $arrResult['seo']->keyword,

            'arrResult'                         => $arrResult

        );
        return view('frontend/content/detail/page')->with($data);
    }
}
