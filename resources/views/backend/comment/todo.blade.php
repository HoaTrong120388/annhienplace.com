@extends('backend.layout')


@section('content')
<form action="{{ URL::route("admin.$strControler.todo") }}" method="post" enctype="multipart/form-data">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">{{$titlePage}}</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button type="submit" class="button text-white bg-theme-1 shadow-md flex items-center"> <i class="w-4 h-4 mr-2" data-feather="save"></i> Save </button>
            <input type="hidden" name="id" value="{{ $arrResult->id ?? 0 }}">
            <input type="hidden" name="idChild" value="{{ $arrResultChild->id ?? 0 }}">
            {{ csrf_field() }}
        </div>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-6 xxl:col-span-6">
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Nội dung đánh giá
                    </h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-12">
                            <div>
                                <label>Fullname</label>
                                <input type="text" class="input w-full border mt-2" placeholder="Họ tên" name="fullname" value="{{ $arrResult->fullname ?? '' }}" disabled>
                            </div>
                            <div class="mt-3">
                                <label>Phone</label>
                                <input type="text" class="input w-full border mt-2" placeholder="Điện thoại" name="phone" value="{{ $arrResult->phone ?? '' }}" disabled>
                            </div>
                            <div class="mt-3">
                                <label>Email</label>
                                <input type="text" class="input w-full border mt-2" placeholder="Email" name="email" value="{{ $arrResult->email ?? '' }}" disabled>
                            </div>
                            <div class="mt-3">
                                <label>Rank</label>
                                <input type="text" class="input w-full border mt-2" placeholder="Mức độ" name="rank" value="{{ $arrResult->rank ?? 5 }}" disabled>
                            </div>
                            <div class="mt-3">
                                <label>Content</label>
                                <textarea class="input w-full border mt-2" placeholder="Nội dung đánh giá" name="message" rows="10">{{ $arrResult->message ?? '' }}</textarea>
                            </div>
                            <div class="mt-3">
                                <label>Published</label>
                                <div class="mt-2">
                                    <input class="input input--switch border" type="checkbox" name="status" @if (isset($arrResult->status) && $arrResult->status == 1) checked @endif>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label>Link bài viết</label>
                                <div class="mt-2">
                                    <a target="_blank" href="{{ $arrResult->link ?? '' }}">{{ $arrResult->link ?? '' }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-6 xxl:col-span-6">
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Trả lời đánh giá
                    </h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-12">
                            <div>
                                <label>Fullname</label>
                                <input type="text" class="input w-full border mt-2" placeholder="Họ tên" name="fullname_reply" value="{{ $arrResultChild->fullname ?? '' }}" >
                            </div>
                            <div class="mt-3">
                                <label>Content</label>
                                <textarea class="input w-full border mt-2" placeholder="Nội dung đánh giá" name="message_reply" rows="10">{{ $arrResultChild->message ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection


@section('headerstyle')
@endsection

@section('footerjs')

@endsection