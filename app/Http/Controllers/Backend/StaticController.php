<?php

namespace App\Http\Controllers\Backend;

use Validator, Session, Storage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

use Carbon\Carbon;

//Helper
use FCommon, Config;

//Model
use App\Model\Order;
use App\Model\Customer;
use App\Model\Setting;
use App\Model\Expense;

class StaticController extends BaseController
{
    protected $messages_error_validator;
    protected $time_now;
    public function __construct()
    {
        $this->messages_error_validator = FCommon::mess_error_validator();
        $this->time_now = Carbon::now();
    }
    public function customerprofit(Request $request)
    {
        if ($request->isMethod('post')) {
            $daterange = isset($request->daterange)?$request->daterange:'';
            $id_customer = isset($request->id_customer)?$request->id_customer:0;
            settype($id_customer, 'int');
            $daterange = FCommon::XoaDinhDang($daterange);
            $arr_date = explode(' - ', $daterange);
            if(is_array($arr_date) && count($arr_date) == 2){
                $date_from = $arr_date[0];
                $date_to = $arr_date[1];
            }
            $arrResult = Order::_static_customer_profit($id_customer, $date_from, $date_to);

        }else{
            $date_from = date('Y/m/d', strtotime('-7 days'));
            $date_to = date('Y/m/d');
            $arrResult = Order::_static_customer_profit(0, $date_from, $date_to);
        }

        $data = array(
            'page_title' => 'Thống kê',
            'page_description' => 'Khách hàng theo thời gian',
            'titlePage' => 'Thống kê doanh thu',

            'arrResult' => $arrResult,
        );
        return view('backend/static/customer-profit')->with($data);
    }
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            FCommon::debug('123');
            $daterange = isset($request->daterange)?$request->daterange:'';
            $daterange = FCommon::XoaDinhDang($daterange);
            $arr_date = explode(' - ', $daterange);
            if(is_array($arr_date) && count($arr_date) == 2){
                $date_from = $arr_date[0];
                $date_to = $arr_date[1];
            }else{
                $date_from = date('Y/m/d', strtotime('-7 days'));
                $date_to = date('Y/m/d');
            }
        }else{
            $date_from = date('Y/m/d', strtotime('-7 days'));
            $date_to = date('Y/m/d');

        }
        $arrResult = Order::_search_order_static($date_from, $date_to);
        $doanhthu = $arrResult->total_money;
        $thucthu = $arrResult->total_in;
        $congno = $doanhthu - $thucthu;
        $chi = Expense::_search_expense_static($date_from, $date_to);

        $data = array(
            'page_title' => 'Thống kê - '.Carbon::parse($date_from)->format('d/m/Y').' đến '.Carbon::parse($date_to)->format('d/m/Y'),
            'page_description' => 'Thu chi theo thời gian',
            'titlePage' => 'Thống kê doanh thu',

            'doanhthu' => $doanhthu,
            'thucthu' => $thucthu,
            'congno' => $congno,
            'chi' => $chi->total_money,
        );
        return view('backend/static/thu-chi')->with($data);
    }
}
