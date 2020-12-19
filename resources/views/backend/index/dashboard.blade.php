@extends('backend.layout')

@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
        <!-- BEGIN: General Report -->
        <div class="col-span-12 mt-8">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Thông tin tài khoản (trong tháng)
                </h2>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="file-text" class="report-box__icon text-theme-11"></i>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{ number_format($total_dichvu,0,',','.') ?? 0 }}</div>
                            <div class="text-base text-gray-600 mt-1">Bài viết dịch vụ</div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="coffee" class="report-box__icon text-theme-12"></i>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{ number_format($total_tintuc,0,',','.') ?? 0 }}</div>
                            <div class="text-base text-gray-600 mt-1">Tin tức</div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="user" class="report-box__icon text-theme-9"></i>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{ number_format($total_contact,0,',','.') ?? 0 }}</div>
                            <div class="text-base text-gray-600 mt-1">Liên hệ</div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="edit" class="report-box__icon text-theme-10"></i>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{ number_format($total_langdingpage,0,',','.') ?? 0 }}</div>
                            <div class="text-base text-gray-600 mt-1">Đăng ký landingPage</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: General Report -->
        <!-- BEGIN: Sales Report -->
        <div class="col-span-12 lg:col-span-12 mt-4">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Bài viết Dịch vụ mới nhất
                </h2>
            </div>
            <div class="intro-y box p-5 mt-12 sm:mt-5">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-no-wrap" width="150">Created</th>
                            <th class="whitespace-no-wrap" width="150">Public</th>
                            <th class="whitespace-no-wrap">Title</th>
                            <th class="whitespace-no-wrap">Author</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($list_post_dichvu) && count((array)$list_post_dichvu) > 0)
                            @foreach ($list_post_dichvu as $item)
                            <tr class="intro-x">
                                <td>{{ Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                <td>{{ Carbon::parse($item->public_date)->format('d-m-Y') }}</td>
                                <td title="{{ $item->title }}"><a href="{{ route("frontend.post.detailfull", [($item->parentcategory)?$item->parentcategory->slug:'danh-muc', $item->slug]) }}">{{ Str::limit($item->title, 100, '...') }}</a></td>
                                <td>{{$item->authr->fullname ?? ''}}</td>
                            </tr>
                            @endforeach
                        @else
                            <h3>Không có dữ liệu phù hợp</h3>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10 pb-10">
        <div class="xxl:pl-6 grid grid-cols-12 gap-6">
            <!-- BEGIN: Transactions -->
            <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-8">
                <div class="intro-x flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Đăng ký thông tin
                    </h2>
                </div>
                <div class="mt-5">
                    @foreach ($list_contact_new as $item)
                        <div class="intro-x">
                            <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                <div class="mr-auto">
                                    <div class="font-medium">{{ $item->fullname }} - {{ $item->phone }}</div>
                                    <div class="text-gray-600 text-xs">{{ $item->created_at }}</div>
                                </div>
                                <div class="@if ($item->status == 1){{ 'text-theme-9' }}@else{{ 'text-theme-6' }}@endif">@if ($item->status == 1){{'Đã xử lý'}}@else{{'Chờ duyệt'}}@endif{{ $item->giatri }}</div>
                            </div>
                        </div>
                    @endforeach
                    <a href="{{ route('admin.contact.index') }}" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">View More</a>
                </div>
            </div>
            <!-- END: Transactions -->
            <!-- BEGIN: Important Notes -->
            <div class="col-span-12 md:col-span-6 xl:col-span-12 xxl:col-span-12 xl:col-start-1 xl:row-start-1 xxl:col-start-auto xxl:row-start-auto mt-3">
                <div class="intro-x flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-auto">
                        Thông báo
                    </h2>
                    <button data-carousel="important-notes" data-target="prev" class="tiny-slider-navigator button px-2 border border-gray-400 dark:border-dark-5 flex items-center text-gray-700 dark:text-gray-600 mr-2"> <i data-feather="chevron-left" class="w-4 h-4"></i> </button>
                    <button data-carousel="important-notes" data-target="next" class="tiny-slider-navigator button px-2 border border-gray-400 dark:border-dark-5 flex items-center text-gray-700 dark:text-gray-600"> <i data-feather="chevron-right" class="w-4 h-4"></i> </button>
                </div>
                <div class="mt-5 intro-x">
                    <div class="box zoom-in">
                        <div class="tiny-slider" id="important-notes">
                            <div class="p-5">
                                <div class="text-base font-medium truncate">Lorem Ipsum is simply dummy text</div>
                                <div class="text-gray-500 mt-1">20 Hours ago</div>
                                <div class="text-gray-600 text-justify mt-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
                                <div class="font-medium flex mt-5">
                                    <button type="button" class="button button--sm bg-gray-200 dark:bg-dark-5 text-gray-600 dark:text-gray-300">View Notes</button>
                                    <button type="button" class="button button--sm border border-gray-300 dark:border-dark-5 text-gray-600 ml-auto">Dismiss</button>
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="font-medium truncate">Lorem Ipsum is simply dummy text</div>
                                <div class="text-gray-500 mt-1">20 Hours ago</div>
                                <div class="text-gray-600 text-justify mt-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
                                <div class="font-medium flex mt-5">
                                    <button type="button" class="button button--sm bg-gray-200 dark:bg-dark-5 text-gray-600 dark:text-gray-300">View Notes</button>
                                    <button type="button" class="button button--sm border border-gray-300 dark:border-dark-5 text-gray-600 ml-auto">Dismiss</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Important Notes -->
        </div>
    </div>
</div>
@endsection

@section('headerstyle')
@endsection
@section('footerjs')
@endsection