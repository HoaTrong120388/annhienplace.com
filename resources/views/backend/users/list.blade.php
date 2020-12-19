@extends('backend.layout')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<h2 class="intro-y text-lg font-medium mt-10">
    {{$titlePage}}
</h2>

<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        @if (FCommon::checkPermissions('admin.user.add'))
            <a href="{{ URL::route('admin.user.add') }}" data-toggle="modal" data-target="#header-footer-modal-preview" class="button text-white bg-theme-1 shadow-md mr-2">Add New</a>
        @endif
        <div class="hidden md:block mx-auto text-gray-600">{{ $str_show_record ?? '' }}</div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-gray-700 dark:text-gray-300">
                <form class="form-horizontal" action="" id="frm_filter_data" >
                    <input type="text" name="keywork" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
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
                    <th class="text-center whitespace-no-wrap">#</th>
                    <th class="text-center whitespace-no-wrap">Permission</th>
                    <th class="text-center whitespace-no-wrap">Full Name</th>
                    <th class="text-center whitespace-no-wrap">Email</th>
                    <th class="text-center whitespace-no-wrap">Phone</th>
                    <th class="text-center whitespace-no-wrap" width="100px">Custom</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($list_users) && count((array)$list_users) > 0)
                    @foreach ($list_users as $user)
                    <tr class="intro-x">
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $user->group_name }}</td>
                        <td class="text-center">{{ $user->fullname }}</td>
                        <td class="text-center">{{ $user->email }}</td>
                        <td class="text-center">{{ $user->phone }}</td>
                        <td class="text-center">
                            <div class="flex justify-center">
                                <div class="dropdown dropdown-content">
                                    <button class="dropdown-toggle button inline-block bg-theme-1 text-white">Actions</button>
                                    <div class="dropdown-box w-48">
                                        <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                                            <a class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md change-password-modal close-dropdown" href="javascript:void(0)"  data-toggle="modal" data-target="#modal-update-password" data-id-user="{{ $user->id }}">
                                                <i data-feather="key" class="w-4 h-4 mr-2"></i>
                                                Đổi password
                                            </a>
                                            <a class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"
                                                href="{{ URL::route('admin.user.edit', $user->id ) }}">
                                                <i data-feather="edit-2" class="w-4 h-4 mr-2"></i>
                                                Thay đổi thông tin
                                            </a>
                                            <a class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"
                                                href="{{ URL::route('admin.user.delete', $user->id ) }}">
                                                <i data-feather="trash-2" class="w-4 h-4 mr-2"></i>
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
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
    {!! $breadcrumb !!}
    <!-- END: Pagination -->
</div>

<div class="modal" id="modal-update-password">
    <div class="modal__content">
        <form class="form-horizontal" action="" id="frm-update-password">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                    Thay đổi mật khẩu
                </h2>
            </div>
            <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                
                <div class="col-span-12 sm:col-span-12">
                    <label>Password mới</label>
                    <input type="password" id="password" name="password" required class="input w-full border mt-2 flex-1" autocomplete="off">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Nhập lại password mới</label>
                    <input type="password" id="password-re" name="repassword" required class="input w-full border mt-2 flex-1" autocomplete="off">
                </div>
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                <button type="button" class="button w-20 bg-theme-1 text-white close-modal" id="btn-submit-form-update-password">Cập nhật</button>
                <input id="user-id-modal" type="hidden" name="id" value="0">
                {{ csrf_field() }}
            </div>
        </form>
    </div>
</div>
@endsection


@section('headerstyle')
@endsection

@section('footerjs')
<script>
    $(document).ready(function() {
        $(".change-password-modal").on('click', function () {
            $("#frm-update-password").trigger('reset');
            $("#user-id-modal").val($(this).data('id-user'));
        });
        $("#btn-submit-form-update-password").on('click', function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var data = $("#frm-update-password").serialize();
            $.ajax({
                type: "POST",
                url: "{{ URL::route('admin.user.updatepassword') }}",
                data: data,
                dataType: "json",
                success: function (response) {
                    if (response.status == 1) {
                        show_noti('Thông tin đã được lưu thành công.', 'success');
                        $("#frm-update-password").trigger('reset');
                    } else {
                        show_noti(response.msg, 'danger');
                    }
                }
            });
        });
    });
</script>
@endsection
