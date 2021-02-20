@extends('backend.layout')
@section('headerstyle')
@endsection
@section('content')
<div class="grid grid-cols-12 gap-6">
    <!-- BEGIN: Profile Menu -->
    <div class="col-span-12 lg:col-span-5 xxl:col-span-5 flex lg:block flex-col-reverse">
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                    Up File Hình
                </h2>
            </div>
            <form action="" method="post" id="frm_menu">
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-12">
                            <div class="flex flex-col sm:flex-row items-center mt-2">
                                <label class="w-full sm:w-20 sm:text-right sm:mr-5">Link</label>
                                <div class="w-full relative border flex-1 rounded-md">
                                    <input type="text" class="input w-full pr-10" placeholder="" name="thumbnail" id="thumbnail">
                                    <a data-fancybox data-type="iframe" data-src="{{ asset('public/all/plugin/filemanager/dialog.php??type=1&field_id=thumbnail') }}" href="javascript:void(0)" class="absolute my-auto inset-y-0 mr-0 right-0 button text-white bg-theme-1 shadow-md">Chọn file</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<form action="{{ route('admin.setting.language') }}" method="post" enctype="multipart/form-data"data-single="true" action="/file-upload" >
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
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2" id="all-content">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">Keyword</th>
                        <th class="whitespace-no-wrap">VI</th>
                        <th class="whitespace-no-wrap">EN</th>
                        <th class="whitespace-no-wrap" width="100"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_lang as $item)    
                        <tr class="intro-x">
                            <td><textarea name="key[]" class="input w-full border mt-2" rows="2">{{ isset($item[0])?$item[0]:'' }}</textarea></td>
                            <td><textarea name="vi[]" class="input w-full border mt-2" rows="2">{{ isset($item[1])?$item[1]:'' }}</textarea></td>
                            <td><textarea name="en[]" class="input w-full border mt-2" rows="2">{{ isset($item[2])?$item[2]:'' }}</textarea></td>
                            <td><a class="flex items-center text-theme-6 remove-item" href="javascript:void(0);" > <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button type="submit" class="button text-white bg-theme-1 shadow-md flex items-center"> <i class="w-4 h-4 mr-2" data-feather="save"></i> Save </button>
            <button type="button" class="button text-white bg-theme-9 shadow-md flex items-center ml-2" id="btn-add-new"> <i class="w-4 h-4 mr-2" data-feather="plus"></i> Add More </button>
            <input type="hidden" name="file" value="{{ $file_name ?? '' }}">
            {{ csrf_field() }}
        </div>
    </div>
</form>
@endsection

@section('footerjs')
<script>
    $(document).ready(function() {
        var html_input = '<tr><td><textarea name="key[]" class="input w-full border mt-2" rows="2"></textarea></td>\
                        <td><textarea name="vi[]" class="input w-full border mt-2" rows="2"></textarea></td>\
                        <td><textarea name="en[]" class="input w-full border mt-2" rows="2"></textarea></td>\
                        <td><a class="flex items-center text-theme-6 remove-item" href="javascript:void(0);" > <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a></td></tr>';
        $("#btn-add-new").on('click', function () {
            $("#all-content tbody").append(html_input);
        })
    });
    $(document).on('click', '.remove-item', function () {
        $(this).closest("tr").remove();
    })
    $("#btn-submit-frm").on('click', function(){
        
        var myForm = document.getElementById('from-info');
        formData = new FormData(myForm);
        console.log(formData);
        
        $.ajax({
            type: "POST",
            url: "{{ URL::route('admin.setting.language') }}",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (response) {                    
                if(response.status == 1){
                    toastr.success('Thông tin đã được lưu thành công.', 'Thành Công');
                    // setTimeout(function(){location.reload();}, 3000);
                }else{
                    toastr.error(response.msg, 'Thất bại');
                }
            }
        });     
    });
</script>
@endsection