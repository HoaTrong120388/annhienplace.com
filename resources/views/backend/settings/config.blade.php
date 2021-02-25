@extends('backend.layout')
@section('content')
<form action="{{ route('admin.setting.config') }}" method="post" enctype="multipart/form-data"data-single="true" action="/file-upload" >
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">{{$titlePage}}</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            {{-- <button type="button" class="button box text-gray-700 dark:text-gray-300 mr-2 flex items-center ml-auto sm:ml-0"> <i class="w-4 h-4 mr-2" data-feather="eye"></i> Preview </button> --}}
            <button type="submit" class="button text-white bg-theme-1 shadow-md flex items-center"> <i class="w-4 h-4 mr-2" data-feather="save"></i> Save </button>
            <input type="hidden" name="id" value="{{ $arrResult->id ?? 0 }}">
            <input type="hidden" name="pageType" value="{{ $pageType ?? 1 }}">
            {{ csrf_field() }}
        </div>
    </div>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Post Content -->
        <div class="intro-y col-span-12 lg:col-span-8">
            <div class="post intro-y overflow-hidden box mt-5">
                <div class="post__tabs nav-tabs flex flex-col sm:flex-row bg-gray-200 dark:bg-dark-2 text-gray-600">
                    <a title="Fill in the article content" data-toggle="tab" data-target="#content" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center active"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Trang Chủ </a>
                    <a title="Adjust the meta title" data-toggle="tab" data-target="#meta-seo" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center"> <i data-feather="code" class="w-4 h-4 mr-2"></i> Seo </a>
                    <a title="Adjust the meta title" data-toggle="tab" data-target="#layout" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center"> <i data-feather="trello" class="w-4 h-4 mr-2"></i> All Page </a>
                    <a title="Adjust the meta title" data-toggle="tab" data-target="#other" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center"> <i data-feather="trello" class="w-4 h-4 mr-2"></i> Other </a>
                </div>
                <div class="post__content tab-content">
                    <div class="tab-content__pane p-5 active" id="content">
                        <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                            <div class="font-medium flex items-center border-b border-gray-200 dark:border-dark-5 pb-5"> <i data-feather="chevron-down" class="w-4 h-4 mr-2"></i> Giới thiệu </div>
                            <div class="mt-5">
                                <textarea class="element-ckeditor-small" id="ckeditor_summary"  name="about_us">{{ $arrResult['about_us'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content__pane p-5" id="meta-seo">
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-5">
                                <div class="col-span-12 xl:col-span-4">
                                    <label>Share Image</label>
                                    <div class="border-2 border-gray-200 border-dashed mt-2">
                                        <input type="file" name="file_main_seo_image" class="dropify" id="main_seo_image" data-default-file="@if (isset($arrResult['main_seo_image'])) {{ FCommon::cover_thumbnail($arrResult['main_seo_image']) }}@endif"  />
                                        <input type="hidden" id="source_main_seo_image" name="main_seo_image" value="{{ $arrResult['main_seo_image'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-span-12 xl:col-span-8">
                                    <div>
                                        <label>Title</label>
                                        <input type="text" class="input w-full border mt-2" name="main_seo_title" value="{{ $arrResult['main_seo_title'] ?? '' }}">
                                    </div>
                                    <div class="mt-3">
                                        <label>Description</label>
                                        <textarea class="input w-full border mt-2" name="main_seo_description">{{ $arrResult['main_seo_description'] ?? '' }}</textarea>
                                    </div>
                                    <div class="mt-3">
                                        <label>Keyword</label>
                                        <input type="text" class="input w-full border mt-2" name="main_seo_keyword" value="{{ $arrResult['main_seo_keyword'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 mt-10">
                                <div class="font-medium flex items-center border-b border-gray-200 dark:border-dark-5 pb-5"> <i data-feather="chevron-down" class="w-4 h-4 mr-2"></i> Header Script </div>
                                <div class="mt-5">
                                    <textarea class="input w-full border mt-2" rows="5" name="header_script">{{ $arrResult['header_script'] ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-span-12 mt-10">
                                <div class="font-medium flex items-center border-b border-gray-200 dark:border-dark-5 pb-5"> <i data-feather="chevron-down" class="w-4 h-4 mr-2"></i> Body Script </div>
                                <div class="mt-5">
                                    <textarea class="input w-full border mt-2" rows="5" name="body_script">{{ $arrResult['body_script'] ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-span-12 mt-10">
                                <div class="font-medium flex items-center border-b border-gray-200 dark:border-dark-5 pb-5"> <i data-feather="chevron-down" class="w-4 h-4 mr-2"></i> Footer Script </div>
                                <div class="mt-5">
                                    <textarea class="input w-full border mt-2" rows="5" name="footer_script">{{ $arrResult['footer_script'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content__pane p-5" id="layout">
                        <div class="grid grid-cols-12 gap-5">
                            <div class="col-span-12">
                                <div>
                                    <label>Logo Website</label>
                                    <div class="border-2 border-gray-200 border-dashed dz-clickable mt-2">
                                        <input type="file" name="file_company_logo_website" class="dropify" id="company_logo_website" data-default-file="@if (isset($arrResult['company_logo_website'])){{ FCommon::cover_thumbnail($arrResult['company_logo_website']) }}@endif"  />
                                        <input type="hidden" id="source_company_logo_website" name="company_logo_website" value="{{ $arrResult['company_logo_website'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label>Favicon</label>
                                    <div class="border-2 border-gray-200 border-dashed dz-clickable mt-2">
                                        <input type="file" name="file_company_fav_icon" class="dropify" id="company_fav_icon" data-default-file="@if (isset($arrResult['company_fav_icon'])){{ FCommon::cover_thumbnail($arrResult['company_fav_icon']) }}@endif"  />
                                        <input type="hidden" id="source_company_fav_icon" name="company_fav_icon" value="{{ $arrResult['company_fav_icon'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label>Banner Header PC</label>
                                    <div class="border-2 border-gray-200 border-dashed dz-clickable mt-2">
                                        <input type="file" name="file_header_banner_pc" class="dropify" id="header_banner_pc" data-default-file="@if (isset($arrResult['header_banner_pc'])){{ FCommon::cover_thumbnail($arrResult['header_banner_pc']) }}@endif"  />
                                        <input type="hidden" id="source_header_banner_pc" name="header_banner_pc" value="{{ $arrResult['header_banner_pc'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label>Banner Header Mobile</label>
                                    <div class="border-2 border-gray-200 border-dashed dz-clickable mt-2">
                                        <input type="file" name="file_header_banner_mobile" class="dropify" id="header_banner_mobile" data-default-file="@if (isset($arrResult['header_banner_mobile'])){{ FCommon::cover_thumbnail($arrResult['header_banner_mobile']) }}@endif"  />
                                        <input type="hidden" id="source_header_banner_mobile" name="header_banner_mobile" value="{{ $arrResult['header_banner_mobile'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label>Banner Form Register</label>
                                    <div class="border-2 border-gray-200 border-dashed dz-clickable mt-2">
                                        <input type="file" name="file_banner_form_register" class="dropify" id="banner_form_register" data-default-file="@if (isset($arrResult['banner_form_register'])){{ FCommon::cover_thumbnail($arrResult['banner_form_register']) }}@endif"  />
                                        <input type="hidden" id="source_banner_form_register" name="banner_form_register" value="{{ $arrResult['banner_form_register'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content__pane p-5" id="other">
                        <div class="mt-5">
                            <label>Liên hệ</label>
                            <input type="text" class="input w-full border mt-2" name="id_page_contact" value="{{ $arrResult['id_page_contact'] ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Post Content -->
        <!-- BEGIN: Post Info -->
        <div class="col-span-12 lg:col-span-4">
            <div class="intro-y box p-5">
                <div class="mt-3">
                    <label class="flex">Website Domain </label>
                    <input class="input w-full border mt-2" name="website_domain" value="{{ $arrResult['website_domain'] ?? '' }}">
                </div>
                <div class="mt-3">
                    <label class="flex">Website Domain </label>
                    <input class="input w-full border mt-2" name="website_domain_admin" value="{{ $arrResult['website_domain_admin'] ?? '' }}">
                </div>
                <div class="mt-3">
                    <label class="flex">Website Domain </label>
                    <input class="input w-full border mt-2" name="website_domain_api" value="{{ $arrResult['website_domain_api'] ?? '' }}">
                </div>
            </div>
        </div>
        <!-- END: Post Info -->
    </div>
</form>
@endsection


@section('headerstyle')

@endsection

@section('footerjs')

@endsection