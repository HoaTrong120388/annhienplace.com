<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\Model\Setting;
use Illuminate\Support\Facades\Lang;
use Jenssegers\Agent\Agent;

use Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $setting_data = Setting::_list();
        $setting_Result = array();
        if(!empty($setting_data) && count($setting_data) > 0){
            foreach ($setting_data as $value) {
                $setting_Result[$value->key_setting] = $value->content;
            }
        }

        $lang_act = isset($_COOKIE['language'])?$_COOKIE['language']:'vi';
        if($lang_act == 'en'){
            $lang_next_key = 'vi';
            $lang_next_value = 'Tiếng Việt';
        }else{
            $lang_next_key = 'en';
            $lang_next_value = 'English';
        }

        $list_duhoc = Lang::get('common.group_study_abroad',[], $lang_act);
        
        View::share('titlePage', 'Hệ thống quản lý Website');
        View::share('descriptionPage', 'Hệ thống quản lý Website');
        View::share('setting_result', $setting_Result);


        View::share('titlePage_Seo', Lang::get('common.main_seo_title',[], $lang_act));
        View::share('descriptionPage_Seo', Lang::get('common.main_seo_description',[], $lang_act));
        View::share('keywordPage_Seo', Lang::get('common.main_seo_keyword',[], $lang_act));

        View::share('group_study_abroad', explode(',', $list_duhoc));

        View::share('language', $lang_act);
        View::share('language_next', array($lang_next_key, $lang_next_value));
        View::share('redirect_lang', '');

        
        $agent = new Agent();
        $is_mobile = ($agent->isPhone())?1:0;
        View::share('is_mobile', $is_mobile);
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Str::macro('currency', function ($price)
        {
            return number_format($price, 2, ',', '.').' đ';
        });
    }
}
