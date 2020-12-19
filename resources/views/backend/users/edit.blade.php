@extends('backend.layout')
@section('headerstyle')
<!-- form Uploads -->
<link href="{{ URL::asset('public/backend/assets/plugins/fileuploads/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Plugins css-->
<link href="{{ URL::asset('public/backend/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('public/backend/assets/plugins/multiselect/css/multi-select.css') }}"  rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('public/backend/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('public/backend/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('public/backend/assets/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('public/backend/assets/plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('public/backend/assets/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('public/backend/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('public/backend/assets/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 text-right">
            @if (FCommon::checkPermissions('admin.user.list'))
            <a href="{{ URL::route('admin.user.list') }}" class="btn btn-success btn-rounded waves-effect waves-light w-md m-b-20 add-new-item">View All</a>
            @endif
            @if (FCommon::checkPermissions('admin.user.add'))
            <a href="{{ URL::route('admin.user.add') }}" class="btn btn-purple btn-rounded waves-effect waves-light w-md m-b-20 add-new-item">Add New</a>
            @endif
        </div>
    </div>
    <form class="form-horizontal row" role="form" enctype="multipart/form-data" method="post" id="from-info">
        <div class="col-md-8">
            <div class="card-box">
                <h4 class="m-t-0 m-b-30 header-title">Thông tin cơ bản</h4>
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="fullName" class="form-control" placeholder="Full Name" value="{{ $info_user->fullname }}">
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{ $info_user->phone }}">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" placeholder="Address" value="{{ $info_user->address }}">
                </div>
                <div class="form-group">
                    <label>Birthday</label>
                    <div class="input-group">
                        <input type="text"  name="birthday" placeholder="yyyy/mm/dd" class="form-control datepicker-choose" value="{{ FCommon::print_Element($info_user->birthday) }}">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="ti-calendar"></i></span>
                        </div>
                    </div>
                    <span class="font-14 text-muted">yyyy-mm-dd</span>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control" name="gender">
                        <option value="1" @if ($info_user->gender == 1) selected @endif >Nam</option>
                        <option value="0" @if ($info_user->gender == 0) selected @endif>Nữ</option>
                        <option value="2" @if ($info_user->gender == 2) selected @endif>Không Xác Định</option>
                    </select>
                </div>
                {{ csrf_field() }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-box">
                <div class="form-group row">
                    <label class="col-4 col-form-label">Status</label>
                    <div class="col-8">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" value="1" name="active" class="custom-control-input" @if ($info_user->active == 1) checked @endif>
                            <label class="custom-control-label" for="customRadio1">Active</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" value="0" name="active" class="custom-control-input" @if ($info_user->active == 0) checked @endif>
                            <label class="custom-control-label" for="customRadio2">InActive</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 col-form-label">Permissions</label>
                    <div class="col-8">
                        <select class="custom-select" name="idgroup">
                            <option @if ($info_user->idgroup == 1) selected @endif value="1">Admin</option>
                            <option @if ($info_user->idgroup == 2) selected @endif value="2">Editer</option>
                            <option @if ($info_user->idgroup == 3) selected @endif value="3">Member</option>
                        </select>
                    </div>
                </div>
                <div class="form-group text-right">
                    <button type="button" class="btn btn-info waves-effect waves-light" id="btn-submit-form">Lưu lại</button>
                </div>
            </div>
        </div>
        <!-- end col -->
        <div class="col-md-6">
            <div class="card-box">
                <h4 class="m-t-0 m-b-30 header-title">Thông tin nạp thẻ</h4>
                <div class="form-group row">
                    <label class="col-4 col-form-label">Api Key</label>
                    <div class="col-8">
                        <input type="text" name="apikey" class="form-control" placeholder="Api Key" value="{{ $info_user->apikey }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 col-form-label">Chiết khấu Viettel</label>
                    <div class="col-8">
                        <input type="text" name="VTT" class="form-control" placeholder="Chiết khấu Viettel" value="{{ $info_user->VTT }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 col-form-label">Chiết khấu Mobifone</label>
                    <div class="col-8">
                        <input type="text" name="VMS" class="form-control" placeholder="Chiết khấu Mobifone" value="{{ $info_user->VMS }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 col-form-label">Chiết khấu Vinaphone</label>
                    <div class="col-8">
                        <input type="text" name="VNP" class="form-control" placeholder="Chiết khấu Vinaphone" value="{{ $info_user->VNP }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 col-form-label">Chiết khấu Vietnam Mobile</label>
                    <div class="col-8">
                        <input type="text" name="VNM" class="form-control" placeholder="Chiết khấu Vietnam Mobile" value="{{ $info_user->VNM }}">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end form -->
</div>

@endsection


@section('footerjs')
<!-- file uploads js -->
<script src="{{ URL::asset('public/backend/assets/plugins/fileuploads/js/dropify.min.js') }}"></script>

<!-- Plugins Js -->
<script src="{{ URL::asset('public/backend/assets/plugins/switchery/switchery.min.js') }}"></script>
<script src="{{ URL::asset('public/backend/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ URL::asset('public/backend/assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
<script src="{{ URL::asset('public/backend/assets/plugins/jquery-quicksearch/jquery.quicksearch.js') }}"></script>
<script src="{{ URL::asset('public/backend/assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ URL::asset('public/backend/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ URL::asset('public/backend/assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}"></script>
<script src="{{ URL::asset('public/backend/assets/plugins/moment/moment.js') }}"></script>
<script src="{{ URL::asset('public/backend/assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ URL::asset('public/backend/assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ URL::asset('public/backend/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('public/backend/assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('public/backend/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>

<script>
    jQuery.browser = {};
    $(document).ready(function() {
        var content_form = '';
        $("#btn-submit-form").on('click', function(){
            var myForm = document.getElementById('from-info');
            formData = new FormData(myForm);
            $.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			});
            $.ajax({
                type: "POST",
                url: "{{ URL::route('admin.user.edit', $info_user->id) }}",
                data: formData,
                dataType: "Json",
                contentType: false,
                processData: false,
                enctype: 'multipart/form-data',
                success: function (response) {
                    if(response.status == 1){
                        toastr.success('Thông tin đã được lưu thành công.', 'Thành Công');
                    }else{
                        toastr.error(response.list_error, 'Thất bại');
                    }
                    console.log(response.msg);
                }
            }); 
            console.log('obj');           
        });

        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong appended.'
            },
            error: {
                'fileSize': 'The file size is too big (1M max).'
            }
        });

        $('.datepicker-choose').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            startDate: '-50y',
            endDate: '-18y'
        });
    });
</script>
@endsection