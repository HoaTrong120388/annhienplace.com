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
        <div class="hidden md:block mx-auto text-gray-600">{{ $str_show_record ?? '' }}</div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-gray-700 dark:text-gray-300">
                <form class="form-horizontal" action="" id="frm_filter_data" >
                    <input type="text" name="keyword" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search..." autocomplete="off" value="{{ $arrFilter['keyword'] ?? '' }}">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                    {{ csrf_field() }}
                </form>
            </div>
        </div>


    </div>
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report mt-2" id="data_table">
            <thead>
                <tr>
                    <th></th>
                    <th class="whitespace-no-wrap" width="150">Created</th>
                    <th class="whitespace-no-wrap" width="150">Public</th>
                    <th class="whitespace-no-wrap">Title</th>
                    <th class="whitespace-no-wrap" width="100">Special</th>
                    <th class="whitespace-no-wrap" width="100">Status</th>
                    <th class="text-center whitespace-no-wrap" width="250">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($arrResult) && count((array)$arrResult) > 0)
                    @foreach ($arrResult as $item)
                    <tr class="intro-x">
                        <td>{{ $item->id }};mk_post</td>
                        <td>{{ Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                        <td>{{ Carbon::parse($item->public_date)->format('d-m-Y') }}</td>
                        <td title="{{ $item->title }}"><a target="_blank" href="{{ route("frontend.post.detailfull", [($item->parentcategory)?$item->parentcategory->slug:'danh-muc', $item->slug]) }}">{{ Str::limit($item->title, 100, '...') }}</a></td>
                        <td>@if ($item->special == 1)Active @else inActive @endif</td>
                        <td>@if ($item->status == 1)Active @else inActive @endif</td>
                        <td class="text-center">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="{{ URL::route("admin.$strControler.todo", ['id' => $item->id] ) }}"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                <a class="flex items-center text-theme-6" onclick="confirm_delete('{{ URL::route("admin.$strControler.delete", ['id' => $item->id] ) }}')" href="javascript:void(0);" > <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <h3>Không có dữ liệu phù hợp</h3>
                @endif
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->
    {{ $arrResult->links('pagination::admin') }}
    <!-- END: Pagination -->
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
        $("#btn-export-form").on('click', function(){
            var data = $("#frm_filter_data").serialize();
            $("#btn-submit-export").click();
        });
        fnc_editTable('{{ route("admin.updatedata") }}', 5, 4);
    });
    $( "#btn-show-modal-filter" ).on('click', function(e){
        e.preventDefault();
        $('#programmatically-dropdown').dropdown('hide');
    });
    
</script>
@endsection
