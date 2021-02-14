@extends('backend.layout')
@section('headerstyle')
@endsection
@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">{{ $titlePage }}</h4>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <!-- <div class="panel-heading">
                    <h4>Invoice</h4>
                </div> -->
                <div class="panel-body">
                    <div class="clearfix">
                        <div class="pull-left">
                            <address>
                                <strong>{{ !empty($setting_result['company_name'])?$setting_result['company_name']:'' }}</strong><br>
                                {{ !empty($setting_result['company_address'])?$setting_result['company_address']:'' }}<br>
                                {{ !empty($setting_result['company_email'])?$setting_result['company_email']:'' }}<br>
                                <abbr title="Phone">P:</abbr> {{ !empty($setting_result['company_phone'])?$setting_result['company_phone']:'' }}
                            </address>
                        </div>
                        <div class="pull-right">
                            <h4>Xuất ngày # <br>
                                <strong>{{ date('Y-m-d H:i:s') }}</strong>
                            </h4>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-left m-t-30">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Khách hàng</th>
                                        <td>{{ $infoResult->fullname }}</td>
                                    </tr>
                                    <tr>
                                        <th>Điện thoại</th>
                                        <td>{{ $infoResult->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Địa chỉ</th>
                                        <td>{{ $infoResult->address }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="pull-right m-t-30">
                                <p><strong>Nhân viên: </strong> {{ $infoResult->nv }}</p>
                                <p class="m-t-10"><strong>Loại đơn hàng: </strong> <span class="label label-pink">@switch($infoResult->group)
                                            @case(2)
                                                Trả Nợ
                                                @break
                                            @case(3)
                                                Trả Hàng
                                                @break
                                            @case(4)
                                                Hàng Bán Ra Toa
                                                @break
                                            @default
                                                Hàng bán không ra toa
                                        @endswitch</span></p>
                                <p class="m-t-10"><strong>Mã đơn hàng: </strong> #{{ $infoResult->id }}</p>
                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->
                    <div class="m-h-50"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table m-t-30">
                                    <thead>
                                        <tr><th>#</th>
                                            <th>Mặt hàng</th>
                                            <th>Số lượng</th>
                                            <th>Đơn giá</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $arr_item = json_decode($infoResult->info_order);
                                            for ($i=0; $i<count($arr_item);$i++ ) {
                                                echo '<tr>';
                                                echo '<td>'.($i+1).'</td>';
                                                echo '<td>'.$arr_item[$i]->product.'</td>';
                                                echo '<td>'.$arr_item[$i]->quantity.'</td>';
                                                echo '<td>'.number_format((float)$arr_item[$i]->price,0,',','.').'</td>';
                                                echo '<td>'.number_format((float)$arr_item[$i]->total,0,',','.').'</td>';
                                                echo '</tr>';
                                            }
                                        @endphp
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-6">
                            <div class="clearfix m-t-40">
                                <h5 class="small text-inverse font-600">Đợn hàng ko bao gồm VAT</h5>
                                <small>
                                    Mọi thông tin chi tiết về đơn hàng có thể liên hệ trực tiếp để được giải đáp rõ hơn.
                                </small>
                            </div>
                        </div>
                        <div class="col-xl-3 col-6 offset-xl-3">
                            <p class="text-right"><b>Tổng đơn hàng:</b> {{ number_format($infoResult->price_total,0,',','.') }}</p>
                            <p class="text-right">Khách hàng thanh toán: {{ number_format($infoResult->price_pay,0,',','.') }}</p>
                            <hr>
                            <h3 class="text-right">{{ number_format($infoResult->price_total,0,',','.') }}</h3>
                        </div>
                    </div>
                    <hr>
                    <div class="d-print-none">
                        <div class="pull-right">
                            <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
                            {{-- <a href="#" class="btn btn-primary waves-effect waves-light">Submit</a> --}}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
</div> <!-- end container -->
@endsection
@section('footerjs')
@endsection
