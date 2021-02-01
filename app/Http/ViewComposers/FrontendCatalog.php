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

        $arrResult    = Catalog::where('status', 1)->where('parent', 0)->get();
        $collection = collect($arrResult);
        $grouped = $collection->groupBy('group');
        $grouped->toArray();
        $view->with('FrontendCatalog', $grouped);
    }
}
