@extends('backend.layout')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<h2 class="intro-y text-lg font-medium mt-10">
    {{$titlePage}}
</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
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
        <table class="table table-report -mt-2" id="data_table">
            <thead>
                <tr>
                    <th></th>
                    <th class="whitespace-no-wrap" width="150">Created</th>
                    <th class="whitespace-no-wrap">Fullname</th>
                    <th class="whitespace-no-wrap">Phone</th>
                    <th class="whitespace-no-wrap">Email</th>
                    <th class="whitespace-no-wrap">Content</th>
                    <th class="text-center whitespace-no-wrap" width="150">Status</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($arrResult) && count((array)$arrResult) > 0)
                    @foreach ($arrResult as $item)
                    <tr class="intro-x">
                        <td>{{ $item->id }};mk_contact</td>
                        <td>{{ Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                        <td>{{ $item->fullname }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <div class="flex items-center ">
                                <a href="javascript:void(0);" onclick="show_full_mess({{ $item->id }})" class="viewDetail">
                                    <i data-feather="maximize-2" class="w-4 h-4 mr-2"></i>
                                </a>
                                {{ Str::limit($item->message, 50) }}
                            </div>
                            <div id="content_{{ $item->id }}" class="hidden">
                                {!! $item->message !!}
                            </div>
                        </td>
                        <td class="text-center">@if ($item->status == 1)Active @else inActive @endif</td>
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
<style>
    .jconfirm.jconfirm-white .jconfirm-box,
    .jconfirm.jconfirm-light .jconfirm-box {
        max-width: 500px;
    }
</style>
@endsection

@section('footerjs')
<script>
    $(document).ready(function() {
        fnc_editTable('{{ route("admin.updatedata") }}', 6);
    });
    function show_full_mess(id) {
        var cnt_mess = $("#content_"+id).html();
        $.dialog({
            'title': false,
            'content': cnt_mess,
            'type': 'blue',
            'boxWidth': '90%',
            'typeAnimated': true,
            'useBootstrap': false,
        });
    }
</script>
@endsection
