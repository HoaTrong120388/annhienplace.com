@extends('backend.layout')


@section('content')
<form action="{{ route('admin.setting.index') }}" method="post" enctype="multipart/form-data">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">{{$titlePage}}</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button type="submit" class="button text-white bg-theme-1 shadow-md flex items-center"> <i class="w-4 h-4 mr-2" data-feather="save"></i> Save </button>
            {{ csrf_field() }}
        </div>
    </div>
    <div class="grid grid-cols-12 gap-6">
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
                                    <img class="rounded-md" src="@if (isset($arrResult['company_logo'])) {{ FCommon::cover_thumbnail($arrResult['company_logo']) }}@else{{ 'dist/images/profile-6.jpg' }}@endif">
                                    <div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2"> <i data-feather="x" class="w-4 h-4"></i> </div>
                                </div>
                                <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                    <button type="button" class="button w-full bg-theme-1 text-white">Change Photo</button>
                                    <input type="file" id="file_choose" class="w-full h-full top-0 left-0 absolute opacity-0" name="logo">
                                    <input type="hidden" name="company_logo" value="{{ $arrResult['company_logo'] ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-8">
                            <div class="">
                                <label>Tên công ty</label>
                                <input type="text" name="company_name" class="input w-full border mt-2" value="{{ isset($arrResult['company_name'])?$arrResult['company_name']:'' }}">
                            </div>
                            <div class="mt-3">
                                <label>Điện thoại</label>
                                <input type="text" name="company_phone" class="input w-full border mt-2" value="{{ isset($arrResult['company_phone'])?$arrResult['company_phone']:'' }}">
                            </div>
                            <div class="mt-3">
                                <label>Điện thoại</label>
                                <input type="text" name="company_phone_2" class="input w-full border mt-2" value="{{ isset($arrResult['company_phone_2'])?$arrResult['company_phone_2']:'' }}">
                            </div>
                            <div class="mt-3">
                                <label>Fax</label>
                                <input type="text" name="company_fax" class="input w-full border mt-2" value="{{ isset($arrResult['company_fax'])?$arrResult['company_fax']:'' }}">
                            </div>
                            <div class="mt-3">
                                <label>Địa chỉ</label>
                                <input type="text" name="company_address" class="input w-full border mt-2"  value="{{ isset($arrResult['company_address'])?$arrResult['company_address']:'' }}">
                            </div>
                            <div class="mt-3">
                                <label>Địa chỉ</label>
                                <input type="text" name="company_email" class="input w-full border mt-2"  value="{{ isset($arrResult['company_email'])?$arrResult['company_email']:'' }}">
                            </div>
                            <div class="mt-3">
                                <label>Email</label>
                                <input type="text" name="company_email_2" class="input w-full border mt-2"  value="{{ isset($arrResult['company_email_2'])?$arrResult['company_email_2']:'' }}">
                            </div>
                            <div class="mt-3">
                                <label>Work Time</label>
                                <textarea type="text" name="company_work_time" class="input w-full border mt-2">{{ isset($arrResult['company_work_time'])?$arrResult['company_work_time']:'' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Display Information -->
            <style>
                textarea#test-area {
  resize: none;
}
            </style>
        </div>
        <!-- BEGIN: Profile Menu -->
        <div class="col-span-12 lg:col-span-4 xxl:col-span-4 flex lg:block flex-col-reverse">
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Social
                    </h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-12">
                            <div class="">
                                <label>Fanpage</label>
                                <input type="text" name="social_fanpage" class="input w-full border mt-2" value="{{ isset($arrResult['social_fanpage'])?$arrResult['social_fanpage']:'' }}">
                            </div>
                            <div class="mt-3">
                                <label>Youtube</label>
                                <input type="text" name="social_youtube" class="input w-full border mt-2" value="{{ isset($arrResult['social_youtube'])?$arrResult['social_youtube']:'' }}">
                            </div>
                            <div class="mt-3">
                                <label>Instagram</label>
                                <input type="text" name="social_instagram" class="input w-full border mt-2" value="{{ isset($arrResult['social_instagram'])?$arrResult['social_instagram']:'' }}">
                            </div>
                            <div class="mt-3">
                                <label>Twitter</label>
                                <input type="text" name="social_twitter" class="input w-full border mt-2"  value="{{ isset($arrResult['social_twitter'])?$arrResult['social_twitter']:'' }}">
                            </div>
                            <div class="mt-3">
                                <label>Linkedin</label>
                                <input type="text" name="social_linkedin" class="input w-full border mt-2"  value="{{ isset($arrResult['social_linkedin'])?$arrResult['social_linkedin']:'' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Other
                    </h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-12">
                            <div class="">
                                <label>Zalo Phone</label>
                                <input type="text" name="zalo_phone" class="input w-full border mt-2" value="{{ isset($arrResult['zalo_phone'])?$arrResult['zalo_phone']:'' }}">
                            </div>
                            <div class="mt-3">
                                <label>Facebook Chat</label>
                                <input type="text" name="company_facebook_chat" class="input w-full border mt-2" value="{{ isset($arrResult['company_facebook_chat'])?$arrResult['company_facebook_chat']:'' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Profile Menu -->

    </div>
</form>
@endsection


@section('headerstyle')
@endsection

@section('footerjs')

@endsection