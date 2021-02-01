@extends('backend.layout')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<h2 class="intro-y text-lg font-medium mt-10">
    {{$titlePage}}
</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        @if (FCommon::checkPermissions("admin.$strControler.todo"))
        <a href="{{ route("admin.$strControler.todo") }}" class="button text-white bg-theme-1 shadow-md mr-2">Add New</a>
        @endif
    </div>
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report mt-2" id="data_table">
            <thead>
                <tr>
                    <th></th>
                    <th class="whitespace-no-wrap" width="50">#</th>
                    <th class="whitespace-no-wrap">Title</th>
                    <th class="whitespace-no-wrap" width="100">Order</th>
                    <th class="whitespace-no-wrap" width="100">Status</th>
                    <th class="text-center whitespace-no-wrap" width="250">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($arrResult) && count((array)$arrResult) > 0)
                    @foreach ($arrResult as $item)
                    <tr class="intro-x">
                        <td>{{ $item->id }};mk_catalog</td>
                        <td>{{ $item->id }}</td>
                        <td title="{{ $item->title }}">{{ Str::limit($item->title, 100, '...') }}</td>
                        <td><input data-table="mk_catalog" data-id="{{ $item->id }}" class="update_order" type="text" value="{{ $item->order ?? '' }}"></td>
                        <td>@if ($item->status == 1)Active @else inActive @endif</td>
                        <td class="text-center">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="{{ URL::route("admin.$strControler.todo", ['id' => $item->id] ) }}"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                <a class="flex items-center text-theme-6" onclick="confirm_delete('{{ URL::route("admin.$strControler.delete", ['id' => $item->id] ) }}')" href="javascript:void(0);" > <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                            </div>
                        </td>
                    </tr>
                    @if(count($item->subcategory))
                        @include('common.item-table-catalog',['subcategories' => $item->subcategory, 'level' => 1])
                    @endif
                    @endforeach
                @else
                    <h3>Không có dữ liệu phù hợp</h3>
                @endif
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
</div>
<!-- BEGIN: Delete Confirmation Modal -->
<div class="modal" id="delete-confirmation-modal">
    <div class="modal__content">
        <div class="p-5 text-center">
            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
            <div class="text-3xl mt-5">Are you sure?</div>
            <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be undone.</div>
        </div>
        <div class="px-5 pb-8 text-center">
            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
            <button type="button" class="button w-24 bg-theme-6 text-white">Delete</button>
        </div>
    </div>
</div>
<!-- END: Delete Confirmation Modal -->
@endsection


@section('headerstyle')
@endsection

@section('footerjs')
<script>
    $(document).ready(function() {
        fnc_editTable('{{ route("admin.updatedata") }}', 4);
    });
</script>
@endsection
