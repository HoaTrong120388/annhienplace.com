<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use FCommon;
use App\Model\Catalog, App\Model\Post;

class FrontendCatalog
{
    public function compose(View $view)
    {
        $language = isset($_COOKIE['language'])?$_COOKIE['language']:'vi';

        $lst_cat = Catalog::_list_all_limit(1, $language);
        $lst_cat->map(function ($item, $key) use ($language) {
            $item->lstPost = Post::_list_post_nav($item->id, 1, $language);
            return $item;
        });
        $view->with('FrontendCatalog', $lst_cat);
    }
}
