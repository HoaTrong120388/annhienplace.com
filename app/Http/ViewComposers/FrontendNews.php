<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use FCommon;
use App\Model\Catalog, App\Model\Post;

class FrontendNews
{
    public function compose(View $view)
    {
        $language = isset($_COOKIE['language'])?$_COOKIE['language']:'vi';
        $data = Post::where('group', 2)->where('special', 1)->paginate(10);
        $view->with('FrontendNews', $data);
    }
}
