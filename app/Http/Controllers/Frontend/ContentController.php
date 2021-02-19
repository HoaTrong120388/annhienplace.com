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
App\Model\PostOption,
App\Model\Catalog,
App\Model\Comment,
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
    public function Pagedetail(Request $request)
    {
        $slug = isset($request->slug)?$request->slug:'';
        $slug = FCommon::ClearStrAll($slug);
        // dd($slug);

        if(empty($slug)) return \abort(404);

        $isTemplate = 0;
        $redirect_lang = '';
        $arrResult = Page::where('status', 1)
                        ->where('slug', $slug)->firstOrfail();

        $breadcrumb[] = array(
                            'link'  => '',
                            'title' => $arrResult->title
                        );

        $arrResult->view = $arrResult->view+1;
        $arrResult->save();
        $group = $arrResult->group;

        $result = FCommon::json_decode_object($arrResult, array('more_info', 'seo'));

        $data = array(
            'titlePage_Seo'         => $result['seo']['title'],
            'descriptionPage_Seo'   => $result['seo']['description'],
            'keywordPage_Seo'       => $result['seo']['keyword'],

            'rs'                    => $result,
            'arrResult'             => $arrResult,
            'breadcrumb'            => $breadcrumb,
            'header_title'          => $arrResult['title']
        );

        if(!empty($arrResult['seo']['image'])) $data['imagePage_Seo'] = $arrResult['seo']['image'];

        return view("frontend/content/page/detail")->with($data);

    }
    public function Postdetail(Request $request)
    {
        $slug = isset($request->slug)?$request->slug:'';
        $slug = FCommon::ClearStrAll($slug);
        // dd($slug);


        if(empty($slug)) return \abort(404);

        $isTemplate = 0;
        $redirect_lang = '';
        $arrResult = Post::select('mk_post.*', 'mk_post_option.more_info')->join('mk_post_option', 'mk_post.id', '=', 'mk_post_option.post_id')
                        ->where('mk_post.status', 1)
                        ->where('mk_post.slug', $slug)->firstOrfail();

        $breadcrumb = array();
        if($arrResult->catalog_id > 0){
            $breadcrumb[] = [
                                'link'  => route("frontend.catalog.detail", $arrResult->parentcategory->slug),
                                'title' => $arrResult->parentcategory->title
                            ];
            if($arrResult->catalogsub_id > 0){
                $breadcrumb[] = [
                                    'link'  => route("frontend.catalog.detail", $arrResult->subcategory->slug),
                                    'title' => $arrResult->subcategory->title
                                ];

                if($arrResult->catalogsubsub_id > 0){
                    $breadcrumb[] = [
                                        'link'  => route("frontend.catalog.detail", $arrResult->subsubcategory->slug),
                                        'title' => $arrResult->subsubcategory->title
                                    ];
                }
            }

        }

        $breadcrumb[] = array(
                            'link'  => '',
                            'title' => $arrResult->title
                        );
                        
        $arrRelated = Post::where('catalog_id', $arrResult->catalog_id)
                        ->where('group', $arrResult->group)
                        ->where('status', 1)
                        ->orderByDesc('id', 'desc')
                        ->paginate(6);

        


        $arrResult->view_count = $arrResult->view_count+1;
        $arrResult->save();
        $group = $arrResult->group;

        $result = FCommon::json_decode_object($arrResult, array('more_info', 'seo', 'album', 'tags'));

        $data = array(
            'titlePage_Seo'         => $result['seo']['title'],
            'descriptionPage_Seo'   => $result['seo']['description'],
            'keywordPage_Seo'       => $result['seo']['keyword'],

            'rs'                    => $result,
            'arrResult'             => $arrResult,
            'breadcrumb'            => $breadcrumb,
            'arrRelated'            => $arrRelated,
            'header_title'          => $arrResult['title']
        );

        if(!empty($arrResult['seo']['image'])) $data['imagePage_Seo'] = $arrResult['seo']['image'];

        $arrComment = $arrResult->comment()->where('status', 1)->where('parent', 0)->orderBy('id', 'desc')->get();
        $data['arrComment'] = $arrComment;

        switch ($group) {
            case 1:
                $folder = 'product';
                break;
            case 3:
                $folder = 'service';
                break;
            case 4:
                $folder = 'catalog';
                break;
            default:
                $folder = 'news';
        }
        return view("frontend/content/$folder/detail")->with($data);

    }
    public function Catalogdetail(Request $request)
    {
        $slug = isset($request->slug)?$request->slug:'';
        $slug = FCommon::ClearStrAll($slug);

        if(empty($slug)) return \abort(404);

        $arrResult = Catalog::where('slug', $slug)->firstOrfail();

        $breadcrumb = array();
        $lstParent = $arrResult->getParentsNames();
        if($lstParent){
            foreach ($lstParent as $item_parent) {
                $breadcrumb[] = array(
                                'link'  => route("frontend.catalog.detail", $item_parent->slug),
                                'title' => $item_parent->title
                            );
            }
        }
        $breadcrumb[] = ['title' => $arrResult->title];

        if($arrResult->subcategory()->where('status', 1)->count() > 0){
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

        $rs = FCommon::json_decode_object($arrResult, array('more_info', 'seo'));
        // dd($arrResult);

        $data = array(

            'titlePage_Seo'             => $rs['seo']['title'],
            'descriptionPage_Seo'       => $rs['seo']['description'],
            'imagePage_Seo'             => $rs['seo']['image'],

            'arrResult'                 => $arrResult,
            'rs'                        => $rs,
            'breadcrumb'                => $breadcrumb,
            'lstResult'                 => $lstResult,
            'header_title'              => $rs['title'],
            'type_list'                 => $type
        );


        $group = $arrResult['group'];
        switch ($group) {
            case 1:
                $folder = 'product';
                break;
            case 3:
                $folder = 'service';
                break;
            case 4:
                $folder = 'catalog';
                break;
            default:
                $folder = 'news';
        }
        return view("frontend/content/$folder/list")->with($data);
    }
    public function newsall(Request $request)
    {
        $breadcrumb[] = ['title' => trans("common.title_service_page_all")];

        $lstResult = Post::where('group', 2)
                                ->where('special', 1)
                                ->where('status', 1)
                                ->orderByDesc('id', 'desc')
                                ->paginate(9);

        $data = array(
            'titlePage_Seo'             => trans("common.title_news_page_all"),
            'descriptionPage_Seo'       => trans("common.title_news_page_all"),
            'imagePage_Seo'             => trans("common.title_news_page_all"),

            'breadcrumb'                => $breadcrumb,
            'lstResult'                 => $lstResult,
            'header_title'              => trans("common.title_news_page_all"),
        );

        return view("frontend/content/news/listall")->with($data);
    }
    public function newstags(Request $request)
    {
        $keyword = isset($request->keyword)?$request->keyword:'';
        $keyword = FCommon::ClearStr($keyword);
        $keyword = urldecode($keyword);
        // dd($keyword);

        
        $breadcrumb[] = ['title' => str_replace("[keyword]", $keyword, trans("common.title_news_tags_page_all"))];

        $lstResult = Post::where('group', 2)
                                ->where('tags', 'like', '%"'.$keyword.'"%')
                                ->where('status', 1)
                                ->orderByDesc('id', 'desc')
                                ->paginate(9);

        $data = array(
            'titlePage_Seo'             => str_replace("[keyword]", $keyword, trans("common.title_news_tags_page_all")),
            'descriptionPage_Seo'       => str_replace("[keyword]", $keyword, trans("common.title_news_tags_page_all")),
            'imagePage_Seo'             => str_replace("[keyword]", $keyword, trans("common.title_news_tags_page_all")),

            'breadcrumb'                => $breadcrumb,
            'lstResult'                 => $lstResult,
            'header_title'              => str_replace("[keyword]", $keyword, trans("common.title_news_tags_page_all")),
        );

        return view("frontend/content/news/listall")->with($data);
    }
    public function productall(Request $request)
    {
        $breadcrumb[] = ['title' => trans("common.title_product_page_all")];

        $lstResult = Post::where('group', 1)
                                ->where('special', 1)
                                ->where('status', 1)
                                ->orderByDesc('id', 'desc')
                                ->paginate(9);

        $data = array(
            'titlePage_Seo'             => trans("common.title_product_page_all"),
            'descriptionPage_Seo'       => trans("common.title_product_page_all"),
            'imagePage_Seo'             => trans("common.title_product_page_all"),

            'breadcrumb'                => $breadcrumb,
            'lstResult'                 => $lstResult,
            'header_title'              => trans("common.title_product_page_all"),
        );

        return view("frontend/content/product/listall")->with($data);
    }
    public function productsearch(Request $request)
    {
        $keyword = isset($request->keyword)?$request->keyword:'';
        $keyword = FCommon::ClearStrAll($keyword);

        
        $breadcrumb[] = ['title' => str_replace("[keyword]", $keyword, trans("common.title_product_search_page_all"))];

        $lstResult = Post::where('group', 1)
                                ->where('title', 'like', "%$keyword%")
                                ->where('status', 1)
                                ->orderByDesc('id', 'desc')
                                ->paginate(9);

        $data = array(
            'titlePage_Seo'             => str_replace("[keyword]", $keyword, trans("common.title_product_search_page_all")),
            'descriptionPage_Seo'       => str_replace("[keyword]", $keyword, trans("common.title_product_search_page_all")),
            'imagePage_Seo'             => str_replace("[keyword]", $keyword, trans("common.title_product_search_page_all")),

            'breadcrumb'                => $breadcrumb,
            'lstResult'                 => $lstResult,
            'header_title'              => str_replace("[keyword]", $keyword, trans("common.title_product_search_page_all")),
        );

        return view("frontend/content/product/listall")->with($data);
    }
    public function producttags(Request $request)
    {
        $keyword = isset($request->keyword)?$request->keyword:'';
        $keyword = FCommon::ClearStr($keyword);
        $keyword = urldecode($keyword);
        // dd($keyword);

        
        $breadcrumb[] = ['title' => str_replace("[keyword]", $keyword, trans("common.title_product_tags_page_all"))];

        $lstResult = Post::where('group', 1)
                                ->where('tags', 'like', '%"'.$keyword.'"%')
                                ->where('status', 1)
                                ->orderByDesc('id', 'desc')
                                ->paginate(9);

        $data = array(
            'titlePage_Seo'             => str_replace("[keyword]", $keyword, trans("common.title_product_tags_page_all")),
            'descriptionPage_Seo'       => str_replace("[keyword]", $keyword, trans("common.title_product_tags_page_all")),
            'imagePage_Seo'             => str_replace("[keyword]", $keyword, trans("common.title_product_tags_page_all")),

            'breadcrumb'                => $breadcrumb,
            'lstResult'                 => $lstResult,
            'header_title'              => str_replace("[keyword]", $keyword, trans("common.title_product_tags_page_all")),
        );

        return view("frontend/content/product/listall")->with($data);
    }
    public function catalogall(Request $request)
    {
        $breadcrumb[] = ['title' => trans("common.title_catalog_page_all")];

        $lstResult = Catalog::where('group', 1)
                                ->where('home', 1)
                                ->where('status', 1)
                                ->orderByDesc('order', 'asc')
                                ->orderByDesc('id', 'desc')
                                ->get();

        $data = array(
            'titlePage_Seo'             => trans("common.title_catalog_page_all"),
            'descriptionPage_Seo'       => trans("common.title_catalog_page_all"),
            'imagePage_Seo'             => trans("common.title_catalog_page_all"),

            'breadcrumb'                => $breadcrumb,
            'lstResult'                 => $lstResult,
            'header_title'              => trans("common.title_catalog_page_all"),
        );

        return view("frontend/content/product/catalogall")->with($data);
    }
    public function serviceall(Request $request)
    {
        $breadcrumb[] = ['title' => trans("common.title_service_page_all")];

        $lstResult = Post::where('group', 3)
                                ->where('special', 1)
                                ->where('status', 1)
                                ->orderByDesc('id', 'desc')
                                ->paginate(9);

        $data = array(
            'titlePage_Seo'             => trans("common.title_service_page_all"),
            'descriptionPage_Seo'       => trans("common.title_service_page_all"),
            'imagePage_Seo'             => trans("common.title_service_page_all"),

            'breadcrumb'                => $breadcrumb,
            'lstResult'                 => $lstResult,
            'header_title'              => trans("common.title_service_page_all"),
        );

        return view("frontend/content/service/listall")->with($data);
    }
    public function servicetags(Request $request)
    {
        $keyword = isset($request->keyword)?$request->keyword:'';
        $keyword = FCommon::ClearStr($keyword);
        $keyword = urldecode($keyword);
        // dd($keyword);

        
        $breadcrumb[] = ['title' => str_replace("[keyword]", $keyword, trans("common.title_service_tags_page_all"))];

        $lstResult = Post::where('group', 3)
                                ->where('tags', 'like', '%"'.$keyword.'"%')
                                ->where('status', 1)
                                ->orderByDesc('id', 'desc')
                                ->paginate(9);

        $data = array(
            'titlePage_Seo'             => str_replace("[keyword]", $keyword, trans("common.title_service_tags_page_all")),
            'descriptionPage_Seo'       => str_replace("[keyword]", $keyword, trans("common.title_service_tags_page_all")),
            'imagePage_Seo'             => str_replace("[keyword]", $keyword, trans("common.title_service_tags_page_all")),

            'breadcrumb'                => $breadcrumb,
            'lstResult'                 => $lstResult,
            'header_title'              => str_replace("[keyword]", $keyword, trans("common.title_service_tags_page_all")),
        );

        return view("frontend/content/service/listall")->with($data);
    }
    public function bookdetail(Request $request)
    {

        $data = array(
            'titlePage_Seo'             => trans("common.title_product_page_all"),
            'descriptionPage_Seo'       => trans("common.title_product_page_all"),
            'imagePage_Seo'             => trans("common.title_product_page_all"),

            // 'breadcrumb'                => $breadcrumb,
            // 'lstResult'                 => $lstResult,
            'header_title'              => trans("common.title_product_page_all"),
            // 'type_list'                 => $type
        );

        return view("frontend/content/catalog/detail")->with($data);
    }
}
