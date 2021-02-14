@extends('backend.layout')
@section('content')
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
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-no-wrap" width="150">Created</th>
                    <th class="whitespace-no-wrap">Fullname</th>
                    <th class="whitespace-no-wrap">Phone</th>
                    <th class="whitespace-no-wrap">Email</th>
                    <th class="whitespace-no-wrap">Content</th>
                    <th class="text-center whitespace-no-wrap" width="250">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($arrResult) && count((array)$arrResult) > 0)
                    @foreach ($arrResult as $item)
                    <tr class="intro-x">
                        <td>{{ Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                        <td>{{ $item->fullname }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->email }}</td>
                        <td><div class="flex items-center "><a href="javascript:void(0);" class="viewDetail"><i data-feather="maximize-2" class="w-4 h-4 mr-2"></i></a> {{ Str::limit($item->message, 50) }} </div></td>
                        <td class="text-center">
                            @if ($item->status == 1)<div class="flex items-center justify-center text-theme-9"> <i data-feather="check-square" class="w-4 h-4 mr-2"></i> Đã xem </div>
                            @else <div class="flex items-center justify-center text-theme-6"> <i data-feather="activity" class="w-4 h-4 mr-2"></i> Đang xử lý </div>
                            @endif
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
            <div class="overflow-x-auto">
                 <table class="table">
                    <tr>
                        <th>Fullname</th>
                        <td>Hoa</td>
                    </tr>
                    <tr>
                        <th>Fullname</th>
                        <td>Hoa</td>
                    </tr>
                    <tr>
                        <th>Fullname</th>
                        <td>Hoa</td>
                    </tr>
                    <tr>
                        <th>Fullname</th>
                        <td>Hoa</td>
                    </tr>
                 </table>
             </div>
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
        $(".viewDetail").on('click', function(){
            $("#delete-confirmation-modal").modal('show');
        });
    });
    $( "#btn-show-modal-filter" ).on('click', function(e){
        e.preventDefault();
        $('#programmatically-dropdown').dropdown('hide');
    });

</script>
@endsection
