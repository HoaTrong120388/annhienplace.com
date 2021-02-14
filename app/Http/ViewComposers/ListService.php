<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use FCommon;
use App\Model\Page;

class ListService
{
    public function compose(View $view)
    {
        $language = isset($_COOKIE['language'])?$_COOKIE['language']:'vi';
        $lst_study_broad = Page::_lst_service($language);
        $collection = collect($lst_study_broad);
        $keyed = $collection->groupBy('parent');
        $keyed->toArray();
        $view->with('lstServiceActive', $keyed);
    }
}
