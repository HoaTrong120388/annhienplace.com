toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};
function show_noti(text, type){
    if(type == 'success')
        toastr.success(text, 'Thành công');
    else if (type == 'danger')
        toastr.error(text, 'Cảnh báo');
    else if (type == 'warning')
        toastr.warning(text, 'Cảnh báo');
    else
        toastr.info(text, 'Thông báo');
}
function confirm_delete(url){
    $.confirm({
        'title': 'Cảnh báo!',
        'content': 'Bạn có thật sự muốn xóa không!',
        'columnClass': 'small',
        'type': 'red',
        'boxWidth': '300px',
        'typeAnimated': true,
        'useBootstrap': false,
        'buttons': {
            'confirm':{
                'text': 'Đồng Ý',
                'btnClass': 'btn-red',
                'action': function(){
                    if(typeof(url) !== undefined)
                        window.location.href = url;
                }
            },
            'cancel':{
                text: 'Hủy'
            }
        }
    });
}
function filePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var obj_frm_preive = input.closest('.uploadForm');
        reader.onload = function (e) {
            $(obj_frm_preive).find('.uploadForm_preview img').remove();
            $(obj_frm_preive).find('.uploadForm_preview').prepend('<img class="rounded-md" src="' + e.target.result + '" />');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function fnc_editTable(url, colstatus, colhot, colhome) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var col_edit = [];
    if(colstatus !== '' && colstatus !== 'undefined') col_edit.push([colstatus, 'status', 'select', '{"1": "Active", "0": "inActive"}']);
    if(colhot !== '' && colhot !== undefined) col_edit.push([colhot, 'special', 'select', '{"1": "Active", "0": "inActive"}']);
    if(colhome !== '' && colhome !== undefined) col_edit.push([colhome, 'home', 'select', '{"1": "Active", "0": "inActive"}']);

    $('#data_table').Tabledit({
        url: url,
        eventType: 'dblclick',
        editButton: false,
        deleteButton: false,
        hideIdentifier: true,
        columns: {
            identifier: [0, 'data'],
            editable: col_edit
        },
        onSuccess: function(response, textStatus, jqXHR) {
            if(response.status == 1){
                show_noti('Cập nhật thành công', 'success');
            }else{
                show_noti('Vui lòng thử lại sau', 'danger');
            }
        }
    });
}
function update_order(){
    $(".update_order").on('change', function(){
            var num = $(this).val();
            var table = $(this).data('table');
            var id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: website_domain_admin+"update-order",
                data: 'table='+table+'&id='+id+'&order='+num,
                dataType: "Json",
                success: function (response) {
                    if(response.status == 1){
                        show_noti('Cập nhật thành công', 'success');
                    }else{
                        show_noti('Vui lòng thử lại sau', 'danger');
                    }
                }
            });
        });
}
$(document).ready(function () {
    $(".file_choose").on('change', function(){
        filePreview(this);
    });
    $('.element-ckeditor').each(function () {
        var id_element = $(this).attr('id');
        CKEDITOR.replace(id_element, {
            filebrowserBrowseUrl: path_public + '/all/plugin/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
            filebrowserUploadUrl: path_public + '/all/plugin/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
            filebrowserImageBrowseUrl: path_public + '/all/plugin/filemanager/dialog.php?type=1&editor=ckeditor&fldr='
        });
    });
    $('.element-ckeditor-small').each(function () {
        var id_element = $(this).attr('id');
        CKEDITOR.replace(id_element, {
            toolbar: [
                { name: 'document', items: ['Source'] },
                { name: 'basicstyles', items: ['Bold', 'Italic'] },
                { name: 'links', items: ['Link', 'Unlink'] },
                { name: 'colors', items: ['TextColor', 'BGColor'] },
            ]
        });
    });
    var drEvent = $('.dropify').dropify({
        maxFileSize: '1M',
        messages: {
            'default': '<div class="text-lg font-medium">Kéo thả hình vào đây hoặc có thể Click</div>',
            'replace': '<div class="text-lg font-medium">Kéo thả hoặc bấm để thay đổi hình</div>',
            'remove': 'Xóa',
            'error': 'Ooops, something wrong appended.'
        },
        error: {
            'fileSize': 'The file size is too big (1M max).'
        },
        tpl: {
            clearButton: '<button type="button" class="dropify-clear 11">{{ remove }}</button>'
        }
    });
    drEvent.on('dropify.afterClear', function (event, element) {
        if (element.element.id != '')
            $("#source_" + element.element.id).val('');
    });
    update_order();
    $('.tagsinput').tagsinput({
        tagClass: 'item-tagsinput',
        trimValue: true,
        confirmKeys: [13, 44, 9, 188]
    });
});