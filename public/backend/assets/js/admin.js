$.fn.editableform.buttons =
'<button type="submit" class="btn btn-primary editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button>' +
'<button type="button" class="btn btn-light editable-cancel btn-sm waves-effect"><i class="mdi mdi-close"></i></button>';
$('.inline-status').editable({
    mode: 'inline',
    source: [
        {value: 1, text: 'Hiện'},
        {value: 0, text: 'Ẩn'}
    ],
    inputclass: 'form-control-sm',
    success: function(response, newValue) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var data = 'table='+$(this).data("table")+'&value='+newValue+'&id='+$(this).data("pk");
        $.ajax({
            type: "POST",
            url: website_domain_admin + "update-status",
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.status == 1){
                    toastr.success('Thông tin đã được lưu thành công.', 'Thành Công');
                }else{
                    toastr.error('Có lỗi cần khắc phục.', 'Thất bại');
                }
            }
        });
    }
});
$('.inline-order').editable({
    type: 'text',
    name: 'order',
    mode: 'inline',
    inputclass: 'form-control-sm',
    success: function(response, newValue) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var data = 'table=mk_libary&value='+newValue+'&id='+$(this).data("id");
        console.log(data);
        $.ajax({
            type: "POST",
            url: "{{ URL::route('admin.updateorder') }}",
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.status == 1){
                    toastr.success('Thông tin đã được lưu thành công.', 'Thành Công');
                }else{
                    toastr.error('Có lỗi cần khắc phục.', 'Thất bại');
                }
            }
        });
    }
});