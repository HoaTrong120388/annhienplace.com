<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


use Validator, Session, Storage;
use Carbon\Carbon;

//Helper
use FCommon, Image;

//Model
use App\Model\Setting;

class SettingController extends BaseController
{
    protected $time_now;
    public function __construct()
    {
        $this->time_now = Carbon::now('Asia/Bangkok');
    }

    public function index(Request $request)
    {

        $full_data = Setting::_list();
        $arrResult = array();
        foreach ($full_data as $value) {
            $arrResult[$value->key_setting] = $value->content;
        }
        $data = array(
            'page_title' => 'Thông Tin Công Ty',
            'titlePage' => 'Thông Tin Công Ty',

            'nav_main'      => 'setting',
            'nav_sub'       => 'setting-index',

            'arrResult' => $arrResult,
        );
        return view('backend/settings/index')->with($data);
    }
    public function settingSubmit(Request $request)
    {
        $data = array(
            'status'    => 0,
            'msg'       => 'No Comment',
        );
        if ($request->isMethod('post'))
        {
            $all_param = $request->all();
            foreach ($all_param as $key => $value) {
                $data = array();
                if($key == '_token')continue;
                if ($key === 'logo') {
                    $path_logo     = '';
                    if ($request->hasFile('logo')) {
                        $ext = $request->logo->getClientOriginalExtension();
                        if(FCommon::check_file_upload($ext, 'image')){
                            $file_logo = $request->file('logo');
                            $path_logo = FCommon::upload_file_crop_size($file_logo, '100x100');
                        }
                    }else{
                        $path_logo = isset($request->company_logo)?$request->company_logo:'';
                    }
                    $data['key_setting'] = 'company_logo';
                    $data['content'] = $path_logo;
                }else{
                    $data['key_setting'] = $key;
                    $data['content'] = $value;
                }
                $chk_detai = Setting::_detail($data['key_setting']);
                if($chk_detai){
                    Setting::_edit($chk_detai->id, $data);
                }else{
                    Setting::_add($data);
                }
            }
            flash('Thông tin đã được lưu')->success();
        }else{
            flash('Có lỗi vui lòng thử lại sau')->error();
        }
        return back();
    }
    public function config(Request $request)
    {

        $full_data = Setting::_list();
        $arrResult = array();
        foreach ($full_data as $value) {
            $arrResult[$value->key_setting] = $value->content;
        }
        // dd($arrResult['about_us']);
        $data = array(
            'page_title' => 'Cài đặt website',
            'titlePage' => 'Cài đặt website',

            'nav_main'      => 'setting',
            'nav_sub'       => 'setting-config',

            'arrResult' => $arrResult,
        );
        return view('backend/settings/config')->with($data);
    }
    public function configSubmit(Request $request)
    {
        $data = array(
            'status'    => 0,
            'msg'       => 'No Comment',
        );
        if ($request->isMethod('post'))
        {
            $all_param = $request->all();

            // if($request->hasFile('file_main_seo_image')) unset($all_param['main_seo_image']);
            // if($request->hasFile('file_header_banner_pc')) unset($all_param['header_banner_pc']);
            // if($request->hasFile('file_header_banner_mobile')) unset($all_param['header_banner_mobile']);
            // if($request->hasFile('file_banner_form_register')) unset($all_param['banner_form_register']);
            // if($request->hasFile('file_company_logo_website')) unset($all_param['company_logo_website']);
            // if($request->hasFile('file_company_fav_icon')) unset($all_param['company_fav_icon']);

            foreach ($all_param as $key => $value) {
                $data = array();
                if($key == '_token')continue;
                  
                if ($key === 'file_main_seo_image') {
                    if ($request->hasFile('file_main_seo_image')) {
                        $ext = $request->file_main_seo_image->getClientOriginalExtension();
                        if(FCommon::check_file_upload($ext, 'image')){
                            $file = $request->file('file_main_seo_image');
                            $path = FCommon::upload_file_crop($file);
                            $data['key_setting'] = 'main_seo_image';
                            $data['content'] = $path;
                        }else continue;
                    }
                }elseif ($key === 'file_header_banner_pc') {
                    if ($request->hasFile('file_header_banner_pc')) {
                        $ext = $request->file_header_banner_pc->getClientOriginalExtension();
                        if(FCommon::check_file_upload($ext, 'image')){
                            $file = $request->file('file_header_banner_pc');
                            $path = FCommon::upload_file_crop($file);
                            $data['key_setting'] = 'header_banner_pc';
                            $data['content'] = $path;
                        }else continue;
                    }
                }elseif ($key === 'file_header_banner_mobile') {
                    if ($request->hasFile('file_header_banner_mobile')) {
                        $ext = $request->file_header_banner_mobile->getClientOriginalExtension();
                        if(FCommon::check_file_upload($ext, 'image')){
                            $file = $request->file('file_header_banner_mobile');
                            $path = FCommon::upload_file_crop($file);
                            $data['key_setting'] = 'header_banner_mobile';
                            $data['content'] = $path;
                        }else continue;
                    }
                }elseif ($key === 'file_banner_form_register') {
                    if ($request->hasFile('file_banner_form_register')) {
                        $ext = $request->file_banner_form_register->getClientOriginalExtension();
                        if(FCommon::check_file_upload($ext, 'image')){
                            $file = $request->file('file_banner_form_register');
                            $path = FCommon::upload_file_crop($file);
                            $data['key_setting'] = 'banner_form_register';
                            $data['content'] = $path;
                        }else continue;
                    }
                }elseif ($key === 'file_company_logo_website') {
                    if ($request->hasFile('file_company_logo_website')) {
                        $ext = $request->file_company_logo_website->getClientOriginalExtension();
                        if(FCommon::check_file_upload($ext, 'image')){
                            $file = $request->file('file_company_logo_website');
                            $path = FCommon::upload_file_crop($file, '220x100');
                            $data['key_setting'] = 'company_logo_website';
                            $data['content'] = $path;
                        }else continue;
                    }
                }elseif ($key === 'file_company_fav_icon') {
                    if ($request->hasFile('file_company_fav_icon')) {
                        $ext = $request->file_company_fav_icon->getClientOriginalExtension();
                        if(FCommon::check_file_upload($ext, 'image')){
                            $file = $request->file('file_company_fav_icon');
                            $path = FCommon::upload_file_crop($file, '30x30');
                            $data['key_setting'] = 'company_fav_icon';
                            $data['content'] = $path;
                        }else continue;
                    }
                }else{
                    $data['content'] = $value;
                    $data['key_setting'] = $key;
                }
                $chk_detai = Setting::_detail($data['key_setting']);
                if($chk_detai){
                    Setting::_edit($chk_detai->id, $data);
                }else{
                    Setting::_add($data);
                }
            }
            flash('Thông tin đã được lưu')->success();
        }else{
            flash('Có lỗi vui lòng thử lại sau')->error();
        }
        return back();
    }
    public function seo(Request $request)
    {

        $full_data = Setting::_list();
        $arrResult = array();
        foreach ($full_data as $value) {
            $arrResult[$value->key_setting] = $value->content;
        }
        $data = array(
            'page_title' => 'Tối ưu seo',
            'titlePage' => 'Tối ưu seo',

            'nav_main'      => 'setting',
            'nav_sub'       => 'setting-seo',

            'arrResult' => $arrResult,
        );
        return view('backend/settings/seo')->with($data);
    }
    public function seoSubmit(Request $request)
    {
        $data = array(
            'status'    => 0,
            'msg'       => 'No Comment',
        );
        if ($request->isMethod('post'))
        {
            $all_param = $request->all();
            foreach ($all_param as $key => $value) {
                $data = array();
                if($key == '_token')continue;
                if ($key === 'file_main_seo_cover') {
                    if ($request->hasFile('file_main_seo_cover')) {
                        $ext = $request->file_main_seo_cover->getClientOriginalExtension();
                        if(FCommon::check_file_upload($ext, 'image')){
                            $file = $request->file('file_main_seo_cover');
                            $path = FCommon::upload_file_crop_size($file, '940x492 ');
                            $data['key_setting'] = 'main_seo_cover';
                            $data['content'] = $path;
                        }else continue;
                    }
                }else{
                    $data['key_setting'] = $key;
                    $data['content'] = $value;
                }
                $chk_detai = Setting::_detail($data['key_setting']);
                if($chk_detai){
                    Setting::_edit($chk_detai->id, $data);
                }else{
                    Setting::_add($data);
                }
            }
            flash('Thông tin đã được lưu')->success();
        }else{
            flash('Có lỗi vui lòng thử lại sau')->error();
        }
        return back();
    }
    public function language(Request $request)
    {
        $file = $request->file;
        if(file_exists(base_path().'/resources/lang/_file/frontend/'.$file.'.json')){
            $content_json = json_decode(file_get_contents(base_path().'/resources/lang/_file/frontend/'.$file.'.json'));
            $all_lang = array();
            if(isset($content_json->vi)){
                $lang_vi = (array)$content_json->vi;
                $lang_en = (array)$content_json->en;
                $all_lang = array();
                foreach($content_json->vi as $key=>$val){
                    $arrLang = array();
                    $arrLang = array(
                        $key,
                        $val,
                        $lang_en[$key]
                    );
                    $all_lang[] = $arrLang;
                }
            }
            
            $data = array(
                'page_title' => 'Cài đặt ngôn ngữ',
                'titlePage' => 'Cài đặt ngôn ngữ',

                'nav_main'      => 'setting',
                'nav_sub'       => 'setting-language',

                'all_lang' => $all_lang,
                'file_name' => $file
            );
            return view('backend/settings/language')->with($data);
        }else{
            return redirect()->route('admin.dashboard');
        }
    }
    public function languageSubmit(Request $request)
    {
        $data = array(
            'status'    => 0,
            'msg'       => 'No Comment',
        );
        if ($request->isMethod('post'))
        {
            $file = isset($request->file)?$request->file:'';
            $key = isset($request->key)?$request->key:'';
            $vi = isset($request->vi)?$request->vi:'';
            $en = isset($request->en)?$request->en:'';
            $arrLang_vi = array();
            $arrLang_en = array();
            $all_lang = array();
            
            if(isset($key) && is_array($key)){
                for($i = 0; $i < count($key); $i++){
                    $all_lang['vi'][$key[$i]] = isset($vi[$i])?$vi[$i]:'';
                    $all_lang['en'][$key[$i]] = isset($en[$i])?$en[$i]:'';
                }
            }
            // dd($all_lang);
            // dd(json_encode($all_lang));
            $fp = fopen(base_path().'/resources/lang/_file/frontend/'.$file.'.json', 'w');
            fwrite($fp, json_encode($all_lang));
            fclose($fp);

            flash('Thông tin đã được lưu')->success();
        }else{
            flash('Có lỗi vui lòng thử lại sau')->error();
        }
        return back()->withInput(array('file' => $file));;
    }

    public function env_key_update(Request $request)
    {
        foreach ($request->types as $key => $type) {
                $this->overWriteEnvFile($type, $request[$type]);
        }

        flash("Settings updated successfully")->success();
        return back();
    }

    public function overWriteEnvFile($type, $val)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            $val = '"'.trim($val).'"';
            if(is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0){
                file_put_contents($path, str_replace(
                    $type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)
                ));
            }
            else{
                file_put_contents($path, file_get_contents($path)."\r\n".$type.'='.$val);
            }
        }
    }
}
