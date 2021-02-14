@extends('backend.layout')
@section('headerstyle')
<!-- Modal -->
<link href="{{ URL::asset('public/backend/assets/plugins/custombox/dist/custombox.min.css') }}" rel="stylesheet">
<!-- Treeview css -->
<link href="{{ URL::asset('public/backend/assets/plugins/jstree/style.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">{{$page_title}}</h4>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-md-6">
            <div class="card-box">
                <h4 class="header-title m-t-0 m-b-30">{{$page_title}}</h4>
                <div id="checkTree">
                    <ul>
                        @foreach ($list_permissions_main as $controller)
                            <li id="{{ $controller->id }}" data-jstree='{"opened":true}'>
                                {{ $controller->name }}
                                <ul>
                                    @foreach ($list_permissions as $action)
                                        @if ($action->parent == $controller->id)
                                        {{ $action->action }}
                                            @if ($action->action == 'index' || $action->action == 'list')
                                                <li id="{{ $action->id }}" data-jstree='{"icon":"mdi mdi-view-list" @if (in_array($action->id, $arrPermissions)), "selected":true @endif }'>
                                            @elseif ($action->action == 'add')
                                                <li id="{{ $action->id }}" data-jstree='{"icon":"mdi mdi-file-plus" @if (in_array($action->id, $arrPermissions)), "selected":true @endif}'>
                                            @elseif ($action->action == 'edit')
                                                <li id="{{ $action->id }}" data-jstree='{"icon":"mdi mdi-square-edit-outline" @if (in_array($action->id, $arrPermissions)), "selected":true @endif}'>
                                            @elseif ($action->action == 'delete')
                                                <li id="{{ $action->id }}" data-jstree='{"icon":"mdi mdi-trash-can-outline" @if (in_array($action->id, $arrPermissions)), "selected":true @endif}'>
                                            @else
                                                <li id="{{ $action->id }}" data-jstree='{"type":"file" @if (in_array($action->id, $arrPermissions)), "selected":true @endif}'>
                                            @endif
                                                {{ $action->name }}
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="form-group text-right">
                    <button type="button" class="btn btn-primary waves-effect waves-light" id="btn-submit-form">Cập nhật</button>
                    {{ csrf_field() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('footerjs')
<!-- Tree view js -->
<script src="{{ URL::asset('public/backend/assets/plugins/jstree/jstree.min.js') }}"></script>
<script src="{{ URL::asset('public/backend/assets/pages/jquery.tree.js') }}"></script>



<script>
    $("#btn-submit-form").on('click', function () {
        var selectedElmsIds = [];
        $("#checkTree").find("li").each(function(i, element) {
            if ($(this).attr("aria-selected") == "true") {
                selectedElmsIds.push($(this).attr('id'));
            }
        });
        console.log(selectedElmsIds.toString());
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{ URL::route('admin.group.permissions', $arrInfo->id) }}",
            data: 'data='+selectedElmsIds.toString(),
            dataType: "Json",
            success: function (response) {
                if(response.status == 1){
                    toastr.success('Thông tin đã được lưu thành công.', 'Thành Công');
                    Custombox.close();
                    setTimeout(function(){location.reload();}, 2000);
                }else{
                    toastr.error(response.list_error, 'Thất bại');
                }
            }
        });
    });
</script>
@endsection