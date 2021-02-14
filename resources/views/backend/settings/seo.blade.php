@extends('backend.layout')
@section('headerstyle')
<!-- form Uploads -->
<link href="{{ URL::asset('public/backend/assets/plugins/fileuploads/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 text-right">
            <a href="javascript:void(0);" class="btn btn-primary btn-rounded waves-effect waves-light w-md m-b-20" id="btn-submit-frm">Update</a>
        </div>
    </div>
    <form class="form-horizontal row" role="form" enctype="multipart/form-data" method="post" id="from-info">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" class="btn-light" name="header_logo" value="{{ isset($arrResult['header_logo'])?$arrResult['header_logo']:'' }}" />
        <input type="hidden" class="btn-light" name="footer_logo" value="{{ isset($arrResult['footer_logo'])?$arrResult['footer_logo']:'' }}" />
        <input type="hidden" class="btn-light" name="favicon" value="{{ isset($arrResult['favicon'])?$arrResult['favicon']:'' }}" />
        <input type="hidden" class="btn-light" name="background_title" value="{{ isset($arrResult['background_title'])?$arrResult['background_title']:'' }}" />
        <input type="hidden" class="btn-light" name="background_home_banner_left" value="{{ isset($arrResult['background_home_banner_left'])?$arrResult['background_home_banner_left']:'' }}" />
        <input type="hidden" class="btn-light" name="background_home_banner_right" value="{{ isset($arrResult['background_home_banner_right'])?$arrResult['background_home_banner_right']:'' }}" />
        <input type="hidden" class="btn-light" name="background_subcscribe" value="{{ isset($arrResult['background_subcscribe'])?$arrResult['background_subcscribe']:'' }}" />
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="card-box">
                        <h4 class="m-t-0 m-b-30 header-title">Image</h4>
                        <div class="card-box">
                            <h4 class="header-title m-t-0 m-b-30">Main Seo Cover</h4>
                            <input type="file" name="file_main_seo_cover" class="dropify" value="" data-default-file="{{ isset($arrResult['main_seo_cover'])?FCommon::cover_thumbnail($arrResult['main_seo_cover']):'' }}"  />
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-8">
                    <div class="card-box">
                        <h4 class="m-t-0 m-b-30 header-title">Content</h4>
                        <div class="form-group">
                            <label>Main Seo Title</label>
                            <textarea name="main_seo_title" class="form-control" rows="4">{{ $arrResult['main_seo_title'] or '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Main Seo Description</label>
                            <textarea name="main_seo_description" class="form-control" rows="4">{{ $arrResult['main_seo_description'] or '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Main Seo Keyword</label>
                            <textarea name="main_seo_keyword" class="form-control" rows="4">{{ $arrResult['main_seo_keyword'] or '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Header Script Custom</label>
                            <textarea name="header_script_custom" class="form-control" rows="4">{{$arrResult['header_script_custom'] or '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Footer Script Custom</label>
                            <textarea name="footer_script_custom" class="form-control" rows="4">{{$arrResult['footer_script_custom'] or '' }}</textarea>
                        </div>
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
<script>
    $(document).ready(function() {
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
    });
    $("#btn-submit-frm").on('click', function(){
        $(this).remove();
        var myForm = document.getElementById('from-info');
        formData = new FormData(myForm);
        $.ajax({
            type: "POST",
            url: "{{ URL::route('admin.setting.config') }}",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (response) {                    
                if(response.status == 1){
                    toastr.success('Thông tin đã được lưu thành công.', 'Thành Công');
                    setTimeout(function(){location.reload();}, 1000);
                }else{
                    toastr.error(response.msg, 'Thất bại');
                }
            }
        });     
    });
</script>
@endsection