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
                            <h3 class="logo">{{ urldecode($infoCatalog->title) }}</h3>
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
                                <address>
                                    <strong>{{ !empty($setting_result['company_name'])?$setting_result['company_name']:'' }}</strong><br>
                                    {{ !empty($setting_result['company_address'])?$setting_result['company_address']:'' }}<br>
                                    {{ !empty($setting_result['company_email'])?$setting_result['company_email']:'' }}<br>
                                    <abbr title="Phone">P:</abbr> {{ !empty($setting_result['company_phone'])?$setting_result['company_phone']:'' }}
                                </address>
                            </div>
                            <div class="pull-right m-t-30">
                                <p><strong>Áp dụng trong tháng: </strong> {{ date('m-Y') }}</p>
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
                                        <tr>
                                            <th>#</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Giá Bán</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($arrResult) && count($arrResult) > 0)
                                            @foreach ($arrResult as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ urldecode($item->title) }}</td>
                                                <td>{{ number_format($item->price_out,0,',','.') }}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-print-none">
                        <div class="pull-right">
                            <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
                            <a href="#" class="btn btn-primary waves-effect waves-light">Submit</a>
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
