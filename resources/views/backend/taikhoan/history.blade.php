@extends('backend.layout')
@section('content')
<h2 class="intro-y text-lg font-medium mt-10">
    {{$titlePage}}
</h2>

<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="col-span-12 lg:col-span-12 xxl:col-span-12">
    <!-- BEGIN: Personal Information -->
    <div class="intro-y box lg:mt-5">
        <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Bộ lọc
            </h2>
        </div>
        <div class="p-5">
            <form class="form-horizontal" action="">
                <div class="grid grid-cols-12 gap-5">
                    <div class="col-span-12 xl:col-span-6">
                        <div>
                            <label>Từ khóa</label>
                            <input type="text" name="keywork" class="input w-full border mt-2" value="{{ $arr_param['keywork'] ?? '' }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-span-12 xl:col-span-2">
                        <div>
                            <label>Trạng thái</label>
                            <select class="input w-full border mt-2" name="type">
                                <option value="-1">Tất cả</option>
                                <option value="1" @if (isset($arr_param['type']) && $arr_param['type']==1) selected
                                    @endif>Nạp tiền</option>
                                <option value="2" @if (isset($arr_param['type']) && $arr_param['type']==2) selected
                                    @endif>Rút tiền</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 xl:col-span-4">
                        <div>
                            <label>Thời gian</label>
                            <input type="text" class="input w-full border mt-2 flex-1 input-daterange-timepicker datepicker" name="daterange" data-daterange="true" value="{{ date('d-m-Y', strtotime('-7 days')) }} - {{ date('d-m-Y') }}" autocomplete="off"/>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="button w-20 bg-theme-1 text-white  mr-1 mb-2">Tìm</button>
                    <a class="button w-20 mr-1 mb-2 bg-theme-6 text-white" href="{{ route('admin.taikhoan.giaodich') }}">Clear</a>
                    {{ csrf_field() }}
                </div>
            </form>
        </div>
    </div>
    <!-- END: Personal Information -->
    </div>
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <div class="hidden md:block mx-auto text-gray-600">Số dữ liệu tìm thấy <b>{{ $totalResult }}</b></div>
    </div>
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="text-center whitespace-no-wrap">Thời gian</th>
                    <th class="text-center whitespace-no-wrap">Loại</th>
                    <th class="text-center whitespace-no-wrap">Nội dung</th>
                    <th class="text-center whitespace-no-wrap">Đầu kỳ</th>
                    <th class="text-center whitespace-no-wrap">Tăng/Giảm</th>
                    <th class="text-center whitespace-no-wrap">Cuối kỳ</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($arrResult) && count((array)$arrResult) > 0)
                    @foreach ($arrResult as $item)
                    <tr>
                        <td class="text-center">{{ $item->created_at }}</td>
                        <td class="text-center">@if ($item->type == 2)Rút tiền
                            @elseif($item->type == 1)Nạp tiền
                            @else Không xác định
                            @endif</td>
                        <td class="text-center">{{ ($item->noidung) }}</td>
                        <td class="text-center">{{ number_format($item->dauvao,0,',','.') }}</td>
                        <td class="text-center">{{ number_format($item->giatri,0,',','.') }}</td>
                        <td class="text-center">{{ number_format($item->daura,0,',','.') }}</td>
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

@endsection


@section('headerstyle')
@endsection

@section('footerjs')
<script>
    $(document).ready(function() {
        
    });
</script>
@endsection
