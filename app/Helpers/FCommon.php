<?php
namespace App\Helpers;
use File, Storage, Image, Str, Session;
define('MINIFY_STRING', '"(?:[^"\\\]|\\\.)*"|\'(?:[^\'\\\]|\\\.)*\'');
define('MINIFY_COMMENT_CSS', '/\*[\s\S]*?\*/');
define('MINIFY_COMMENT_HTML', '<!\-{2}[\s\S]*?\-{2}>');
define('MINIFY_COMMENT_JS', '//[^\n]*');
define('MINIFY_PATTERN_JS', '/[^\n]+?/[gimuy]*');
define('MINIFY_HTML', '<[!/]?[a-zA-Z\d:.-]+[\s\S]*?>');
define('MINIFY_HTML_ENT', '&(?:[a-zA-Z\d]+|\#\d+|\#x[a-fA-F\d]+);');
define('MINIFY_HTML_KEEP', '<pre(?:\s[^<>]*?)?>[\s\S]*?</pre>|<code(?:\s[^<>]*?)?>[\s\S]*?</code>|<script(?:\s[^<>]*?)?>[\s\S]*?</script>|<style(?:\s[^<>]*?)?>[\s\S]*?</style>|<textarea(?:\s[^<>]*?)?>[\s\S]*?</textarea>');
class FCommon
{
    public static function arry_group_permission(){
        return array(
            1 => 'Member',
            2 => 'Editer',
            3 => 'Admin',
        );
    }
    public static function file_upload_allow(){
        $arr_file_allow = array(
            'image' => array('png', 'jpg', 'gif', 'webp'),
            'video' => array('mp4'),
        );
        return $arr_file_allow;
    }
    public static function check_file_upload($ext, $type){
        $ext = strtolower($ext);
        if(in_array($ext, FCommon::file_upload_allow()[$type])){
            return true;
        }
        return false;
    }
    public static function debug($value, $status = false){
        echo '<pre>';
        print_r($value);
        echo '</pre>';
        if($status == true) exit;
    }
    public static function map_file_css(){
        return array(
            'backend_theme'     => 'backend/dist/css/common.css',
            'frontend_theme'    => 'frontend/css/style.min.css',
        );
    }
    public static function map_file_js(){
        return array(
            'backend_theme' => 'backend/dist/js/common.js',
            'frontend_theme' => 'frontend/js/theme.min.js',
        );
    }
    public static function minifycss($str_file = '', $flag = 1){
        $minified = "";
        if(!empty($str_file)){
            $arr_css = explode(",",$str_file);
            if(!empty($arr_css) && count($arr_css) > 0){
                foreach ($arr_css as $key => $value) {
                    if(isset(FCommon::map_file_css()[$value])){
                        $minify_css = File::get(public_path(FCommon::map_file_css()[$value]));
                        $minified .= Minify::minify_css($minify_css);
                    }else{
                        $minify_css = File::get($value);
                        $minified .= Minify::minify_css($minify_css);
                    }
                }
            }
        }
        return '<style type="text/css">'.$minified.'</style>';
    }
    public static function minifyjs($str_file = ''){
        $minified = "";
        if(!empty($str_file)){
            $arr_js = explode(",",$str_file);
            if(!empty($arr_js) && count($arr_js) > 0){
                foreach ($arr_js as $key => $value) {
                    if(isset(FCommon::map_file_js()[$value])){
                        $minify_js = File::get(public_path(FCommon::map_file_js()[$value]));
                        $minified .= Minify::minify_js($minify_js);
                    }else{
                        $minify_js = File::get($value);
                        $minified .= Minify::minify_js($minify_js);
                    }
                }
            }
        }
        return '<script>'.$minified.'</script>';
    }
    public static function stripUnicode($str){
        $str = str_replace(array(',', '<', '>', '&', '{', '}', '*', '?', '/', ':',  '"', '\'', '\\', '@', '!', '*', '#', '(', ')', '&', '.', '^', '~', '+', '_', '“', '”', '%', '`'), array(' '), $str);
        if(!$str) return false;
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd'=>'đ',
            'D'=>'Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
        );
        foreach($unicode as $khongdau=>$codau){
            $arr = explode("|",$codau);
            $str = str_replace($arr,$khongdau,$str);
        }
        $str = preg_replace('/\s+/',' ',$str);
        $str = rtrim($str);
        $str = str_replace(" ","-",$str);
        $str = preg_replace('/-+/','-',$str);
        $str = strtolower($str);
        return $str;
    }
    public static function show($filename)
    {
        $path = storage_path() . '/img/' . $filename;
        if(!File::exists($path)) abort(404);
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
    public static function ClearStr ($str)
    {
        $str = trim(strip_tags($str, '<p><a><br>'));
        return $str;
    }
    public static function ClearStrAll ($str)
    {
        $str = htmlentities(trim(strip_tags($str)));
        return $str;
    }
    public static function breadcrumb($url = '', $totalRows , $pageNum = 1, $pageSize = 5, $offset = 5)
    {
        if ($totalRows <= 0) return "";
        $totalPages = ceil($totalRows/$pageSize);
        if ($totalPages <= 1) return "";
        $firstLink = "";  $prevLink = "";  $lastLink = "";  $nextLink = "";
        if ($pageNum > 1) {
            $firstLink = '<li class="page-item"><a class="page-link" href="'.$url.'" aria-label="Previous"><span aria-hidden="true">«</span></a></li>';
            $prevPage = $pageNum - 1;
        }
        $from = $pageNum - $offset;
        $to = $pageNum + $offset;
        if ($from <=0) { $from = 1;   $to = $offset*2; }
        if ($to > $totalPages) { $to = $totalPages; }
        $links = "";
        for($j = $from; $j <= $to; $j++) {
            {
                if ($j==$pageNum)
                    $links = $links . '<li class="page-item active"><a class="page-link" href="javascript:void(0);">'.$j.'</a></li>';
                else
                    $links = $links . '<li class="page-item"><a class="page-link" href="'.$url.'/'.$j.'">'.$j.'</a></li>';;
            }
        }
        if ($pageNum < $totalPages) {
            $lastLink = '<li class="page-item"><a class="page-link" href="'.$url.'/'.$totalPages.'" aria-label="Previous"><span aria-hidden="true">»</span></a></li>';
            $nextPage = $pageNum + 1;
        }
        return '<nav><ul class="pagination pagination-split justify-content-end">'.$firstLink.$prevLink.$links.$nextLink.$lastLink.'</ul></nav>';
    }
    public static function breadcrumb_search($url = '', $totalRows , $pageNum = 1, $pageSize = 5, $offset = 5)
    {
        if ($totalRows <= 0) return "";
        $totalPages = ceil($totalRows/$pageSize);
        if ($totalPages <= 1) return "";
        $firstLink = "";  $prevLink = "";  $lastLink = "";  $nextLink = "";
        if ($pageNum > 1) {
            $firstLink = '<li><a class="pagination__link" href="'.$url.'"> <i class="w-4 h-4" data-feather="chevrons-left"></i> </a></li>';
            $prevPage = $pageNum - 1;
        }
        $from = $pageNum - $offset;
        $to = $pageNum + $offset;
        if ($from <=0) { $from = 1;   $to = $offset*2; }
        if ($to > $totalPages) { $to = $totalPages; }
        $links = "";
        for($j = $from; $j <= $to; $j++) {
            {
                if ($j==$pageNum)
                    $links = $links . '<li> <a class="pagination__link pagination__link--active" href="javascript:void(0);">'.$j.'</a> </li>';
                else
                    $links = $links . '<li> <a class="pagination__link" href="'.$url.'&page='.$j.'">'.$j.'</a> </li>';
            }
        }
        if ($pageNum < $totalPages) {
            $lastLink = '<li><a class="pagination__link" href="'.$url.'&page='.$totalPages.'"> <i class="w-4 h-4" data-feather="chevrons-right"></i> </a></li>';
            $nextPage = $pageNum + 1;
        }
        return '<div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center"><ul class="pagination">'.$firstLink.$prevLink.$links.$nextLink.$lastLink.'</ul></div>';
    }
    public static function upload_file_crop($file, $size = '')
    {
        $year = date("Y");
        $month = date("m");
        $day = date("d");

        $ext = $file->getClientOriginalExtension();

        $fileName = str_replace($ext, '', $file->getClientOriginalName());
        $imageName = Str::slug($fileName).'-'.time().'.'.$ext;

        $path = $year.'/'.$month.'/'.$day.'/';
        if(!empty($size)){
            $path_custom = public_path("../upload/$size/$path");
            $array_size = explode('x', $size);
        }
        $path_full  = public_path('../upload/full/'.$path);

        if(!File::isDirectory($path_full)) File::makeDirectory($path_full, 0755, true, true);

        if(isset($array_size) && is_array($array_size) && count($array_size) == 2){
            if(!File::isDirectory($path_custom)) File::makeDirectory($path_custom, 0755, true, true);
            $img = Image::make($file->getRealPath());
            $img->resize($array_size[0], $array_size[1])->save($path_custom.$imageName);
        }
        $file->move($path_full, $imageName);
        // dd(11);
        return $path.$imageName;
    }
    public static function upload_file_crop_size($file, $size = '', $key_file_name = '')
    {
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $ext = $file->getClientOriginalExtension();
        $fileName = str_replace($ext, '', $file->getClientOriginalName());
        if(!empty($key_file_name))
            $imageName = $key_file_name.'-'.time().'-'.Str::random(10).'.'.$ext;
        else
            $imageName = Str::slug($fileName).'-'.time().'-'.Str::random(10).'.'.$ext;
        $path = $year.'/'.$month.'/'.$day.'/';
        $dir_full  = public_path('../upload/full/'.$path);
        $dir = public_path('../upload/'.$size.'/'.$path);
        if(!File::isDirectory($dir)) File::makeDirectory($dir, 0755, true, true);
        if(!File::isDirectory($dir_full)) File::makeDirectory($dir_full, 0755, true, true);
        $arr_size = explode('x', $size);
        if(is_array($arr_size) && count($arr_size) == 2){
            $img = Image::make($file->getRealPath());
            $img->fit($arr_size[0], $arr_size[1])->save($dir.$imageName);
        }
        $file->move($dir_full, $imageName);


        return $path.$imageName;
    }

    public static function cover_to_Webp($path, $file)
    {
        $image = imagecreatefromstring(file_get_contents($file));
        ob_start();
        imagejpeg($image,NULL,100);
        $cont = ob_get_contents();
        ob_end_clean();
        imagedestroy($image);
        $content = imagecreatefromstring($cont);
        $output = public_path('output.webp');
        imagewebp($content,$output);
        imagedestroy($content);
    }
    public static function print_Element ($element)
    {
        return (isset($element)&&!empty($element))?urldecode($element):'';
    }
    public static function resize_image ($url, $size = '')
    {
        $path_img_full = 'upload/full/'.$url;
        $img = Image::make(base_path($path_img_full));
        
        if($size != ''){
            $arr_size = explode('x', $size);
            if(is_array($arr_size) && count($arr_size) == 2){
                $width = $arr_size[0];
                $height = $arr_size[1];
            }else{
                $width = $height = $arr_size[0];
            }
            $path_img_size = 'upload/'.$width.'x'.$height.'/'.$url;
            $arr_tem_path = explode('/', $path_img_size);
            array_pop($arr_tem_path);
            $path_folder = implode('/', $arr_tem_path);
            $dir_size = base_path($path_folder);
            if(!File::isDirectory($dir_size)) File::makeDirectory($dir_size, 0755, true, true);
            // dd($width);
            if($width == 'null' || $height == 'null'){
                $img->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($path_img_size);
            }else{
                $img->fit($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($path_img_size);
            }
        }
        return secure_asset($path_img_size);
    }
    public static function cover_thumbnail ($url, $size = '')
    {
        
        $path_img_full = 'upload/full/'.$url;
        $path_img_size = 'upload/'.$size.'/'.$url;
        $path_img_blank = 'public/all/images/blank.png';

        if(empty($url)) return secure_asset($path_img_blank);

        if($size != ''){

            $arr_size = explode('x', $size);
            if(is_array($arr_size) && count($arr_size) == 2){
                $width = $arr_size[0];
                $height = $arr_size[1];
            }else{
                $width = $height = $arr_size[0];
            }
            $path_img_size = 'upload/'.$width.'x'.$height.'/'.$url;

            if(!File::exists(public_path('../'.$path_img_size))){
                if(File::exists(public_path('../'.$path_img_full))){
                    return FCommon::resize_image($url, $size);
                }
                return secure_asset($path_img_blank);
            }
            return secure_asset($path_img_size);
        }else{
            return secure_asset($path_img_full);
        }

        return secure_asset($path_img_blank);
    }
    public static function full_link_image ($path, $size = '')
    {
        if(!empty($size))
            return '../upload/'.$size.'/'.$path;
        return '../upload/full/'.$path;
    }
    public static function checkPermissions($role='')
    {
        $lst_Permissions_action = session('lst_Permissions_action');
        // echo ($role);
        if($role == 'adminmaster'){
            if(session('user_group') == 10001) return true;
            return false;
            // dd(11);
        }else{
            if(session('user_group') == 10001) return true;
            if(in_array($role, $lst_Permissions_action)) return true;
            return false;
        }
    }
    public static function cover_Title_db($arrResult='')
    {
        if(empty($arrResult) || count($arrResult) < 1) exit;
        $collection = collect($arrResult);
        $newcollection = $collection->map(function ($values) {
            $values->title = urldecode($values->title);
            return $values;
        });
        return $newcollection->all();
    }
    public static function json_decode_object($arrResult, $arrKey)
    {
        if(!isset($arrResult) || empty($arrResult)) exit;
        if(!isset($arrKey) || empty($arrKey)) exit;

        $collection = collect($arrResult);
        $arrResult_Cover = $collection->map(function ($item, $key) use($arrKey){
            if(in_array($key, $arrKey))
                return json_decode($item, true);
            return $item;
        });
        return $arrResult_Cover->toArray();
    }
    public static function coverData($arrResult, $arrKey)
    {
        if(!isset($arrResult) || empty($arrResult)) exit;
        if(!isset($arrKey) || empty($arrKey)) exit;

        $collection = collect($arrResult);
        $arrResult_Cover = $collection->map(function ($item, $key) use($arrKey){
            return json_decode_object($item, $arrKey);
        });
        return $arrResult_Cover->toArray();
    }
    public static function hide_mid_number($number)
    {
        return substr($number, 0, 3) . '******' . substr($number, -3);
    }
    public static function conver_date ($date)
    {
        if(empty($date)) return false;
        $arrValue = explode('-', $date);
        if(count($arrValue) !== 3) return false;

        settype($arrValue[0], 'int');
        settype($arrValue[1], 'int');
        settype($arrValue[2], 'int');
        return $arrValue[2].'-'.$arrValue[1].'-'.$arrValue[0];
    }
    public static function format_data_to_group ($data, $name_group)
    {
        if(empty($data) || empty($name_group)) return null;
        $grouped = $data->groupBy($name_group);
        $grouped->toArray();
        return $grouped;
    }
    public static function sendMess ($msg = 'Test thông báo', $group = '-526370746', $bot = '1511935022:AAHzO7gPP4HC2WMD1lIvHlrdD3bs4tLInYQ')
    {
        $client = new \GuzzleHttp\Client(['headers' => [ 'Content-Type' => 'application/json' ]]);
        $res = $client->post('https://api.telegram.org/bot'.$bot.'/sendMessage',
            [
                'body' => json_encode
                (
                    [
                        'chat_id' => $group,
                        'text' => $msg
                    ]
                ),
                'verify' => false
            ]);
        $response = json_decode($res->getBody());
    }
    public static function countRanking ($arrComment)
    {
        $rate_1 = 0;
        $rate_2 = 0;
        $rate_3 = 0;
        $rate_4 = 0;
        $rate_5 = 0;
        foreach ($arrComment as $comment) {
            $ranking = $comment->ranking;

            switch ($ranking) {
                case '1':
                    $rate_1 += 1;
                    break;
                case '2':
                    $rate_2 += 2;
                    break;
                case '3':
                    $rate_3 += 3;
                    break;
                case '4':
                    $rate_4 += 4;
                    break;
                case '5':
                    $rate_5 += 5;
                    break;
            }
        }
        $sum_rate_point = $rate_1 + $rate_2 + $rate_3 + $rate_4 + $rate_5;

        $rank_product = $sum_rate_point /  $arrComment->count();
        $rank_product = round($rank_product);
        settype($rank_product, 'int');
        
        return $rank_product;
    }
}