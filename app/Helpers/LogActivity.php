<?php
namespace App\Helpers;

use App\Model\LogActivity as LogActivityModel;
use Route, Request;


class LogActivity
{


    public static function addToLog($subject, $description, $type = 1)
    {
        $log = [];
        $log['type']        = $type;
        $log['as']          = Route::currentRouteName();
        $log['subject']     = $subject;
        $log['description'] = $description;
        $log['url']         = Request::fullUrl();
        $log['method']      = Request::method();
        $log['ip']          = Request::ip();
        $log['agent']       = Request::header('user-agent');
        $log['user_id']     = session('user_id') ? session('user_id') : 0;
        LogActivityModel::create($log);
    }


    public static function logActivityLists()
    {
    	return LogActivityModel::latest()->get();
    }


}