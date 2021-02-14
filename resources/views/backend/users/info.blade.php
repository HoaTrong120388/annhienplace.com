@extends('backend.layout')


@section('content')
<form action="{{ URL::route('admin.user.info') }}" method="post" enctype="multipart/form-data">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">{{$titlePage}}</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button type="submit" class="button text-white bg-theme-1 shadow-md flex items-center"> <i class="w-4 h-4 mr-2" data-feather="save"></i> Save </button>
            <input type="hidden" name="id" value="{{ $info_user->id ?? '' }}">
            <input type="hidden" name="pageType" value="{{ $pageType ?? 1 }}">
            {{ csrf_field() }}
        </div>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        <div class="col-span-12 lg:col-span-4 xxl:col-span-4 flex lg:block flex-col-reverse">
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Thông tin đăng nhập
                    </h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-12">
                            <div>
                                <label>Email</label>
                                <input type="text" class="input w-full border mt-2" placeholder="Email" name="email" value="{{ $info_user->email ?? '' }}" disabled>
                            </div>
                            <div class="mt-3">
                                <label>Password</label>
                                <input type="password" class="input w-full border mt-2" placeholder="Mật khẩu" name="password" value="{{ $info_user->email ?? '' }}" disabled>
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
                        Thông tin hiển thị
                    </h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-4">
                            <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                                <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto" id="uploadForm">
                                    <img class="rounded-md" src="@if (isset($info_user->avatar)) {{ FCommon::cover_thumbnail($info_user->avatar) }}@else{{ 'dist/images/profile-6.jpg' }}@endif">
                                    <div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2"> <i data-feather="x" class="w-4 h-4"></i> </div>
                                </div>
                                <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                    <button type="button" class="button w-full bg-theme-1 text-white">Change Photo</button>
                                    <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0" name="thumbnail">
                                    <input type="hidden" name="avatar" value="{{ $info_user->avatar ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-8">
                            <div>
                                <label>Họ tên</label>
                                <input type="text" class="input w-full border mt-2" placeholder="Họ tên" name="fullname" value="{{ $info_user->fullname ?? '' }}">
                            </div>
                            <div class="mt-3">
                                <label>Điện thoại</label>
                                <input type="text" class="input w-full border mt-2" placeholder="Điện thoại" name="phone" value="{{ $info_user->phone ?? '' }}">
                            </div>
                            <div class="mt-3">
                                <label>Địa chỉ</label>
                                <textarea class="input w-full border mt-2" placeholder="Địa chỉ" name="address">{{ $info_user->address ?? '' }}</textarea>
                            </div>
                            <div class="mt-3">
                                <label>Sinh nhật</label>
                                <input type="text" class="input w-full border bg-gray-100 cursor-not-allowed mt-2 datepicker" placeholder="Sinh nhật" name="birthday" data-single-mode="true" data-birday="true" value="{{ $info_user->birthday ?? '' }}">
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
@endsection

@section('footerjs')

@endsection