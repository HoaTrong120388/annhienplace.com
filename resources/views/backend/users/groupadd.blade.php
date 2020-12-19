@extends('backend.layout')


@section('content')
<form action="{{ URL::route('admin.group.add') }}" method="post" enctype="multipart/form-data">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">{{$titlePage}}</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button type="submit" id="btn-submit-form" class="button text-white bg-theme-1 shadow-md flex items-center"> <i class="w-4 h-4 mr-2" data-feather="save"></i> Save </button>
            <input type="hidden" name="id" value="{{ $arrResult->id ?? '' }}">
            <input type="hidden" name="pageType" value="{{ $pageType ?? 1 }}">
            <input type="hidden" name="permissions" id="permissions" value="">
            {{ csrf_field() }}
        </div>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        <div class="col-span-12 lg:col-span-4 xxl:col-span-4 flex lg:block flex-col-reverse">
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Thông tin
                    </h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-12">
                            <div>
                                <label>Name</label>
                                <input type="text" class="input w-full border mt-2" placeholder="name" name="name" value="{{ $arrResult->name ?? '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 xxl:col-span-8">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Permission
                    </h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-12">
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
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Display Information -->
        </div>
    </div>
</form>
@endsection

@section('headerstyle')
<link href="{{ URL::asset('public/backend/dist/plugins/jstree/style.css') }}" rel="stylesheet" type="text/css" />
@endsection


@section('footerjs')
<script src="{{ asset('public/backend/dist/plugins/jstree/jstree.min.js') }}"></script>
<script src="{{ asset('public/backend/assets/pages/jquery.tree.js') }}"></script>
<script>
    $("#checkTree").on('changed.jstree', function (e, data){
        var selectedElmsIds1 = [];
        var selectedElms = $('#checkTree').jstree("get_selected", true);
        $.each(selectedElms, function() {
            selectedElmsIds1.push(this.id);
        });
        $("#permissions").val(selectedElmsIds1.toString());
    });
</script>
@endsection