$(document).ready(function() {
	toastr.options = {
	    "closeButton": false,
	    "debug": false,
	    "newestOnTop": false,
	    "progressBar": true,
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
	$('.filter-daterange-picker').daterangepicker({
		autoUpdateInput: false,
		timePickerIncrement: 30,
		buttonClasses: ['btn', 'btn-sm'],
		applyClass: 'btn-success',
		cancelClass: 'btn-primary',
		minYear: parseInt(moment().subtract(10, 'years').format('YYYY'),10),
		maxYear: parseInt(moment().add(10, 'years').format('YYYY'), 10),
		"locale": {
			"format": "YYYY/MM/DD",
		}
	});
	$('.filter-daterange-picker').on('apply.daterangepicker', function (ev, picker) {
		$(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
	});

	$('.filter-daterange-picker').on('cancel.daterangepicker', function (ev, picker) {
		$(this).val('');
	});
	$('.element-ckeditor').each(function () {
		var id_element = $(this).attr('id');
		CKEDITOR.replace( id_element , {
			filebrowserBrowseUrl : path_public + '/all/plugin/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
			filebrowserUploadUrl : path_public + '/all/plugin/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
			filebrowserImageBrowseUrl : path_public + '/all/plugin/filemanager/dialog.php?type=1&editor=ckeditor&fldr='
		});
	});
	$('.element-ckeditor-small').each(function () {
		var id_element = $(this).attr('id');
		CKEDITOR.replace( id_element , {
			toolbar: [
				{ name: 'document', items: [ 'Source'] },
				{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] },
				{ name: 'links', items: [ 'Link', 'Unlink' ] },
				{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
			],
		});
	});
});