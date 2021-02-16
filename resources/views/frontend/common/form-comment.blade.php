<!-- === add comment === -->
<div class="comment-add">
    <div class="comment-reply-message">
        <div class="h3 title">Đánh giá bài viết </div>
        <p>Thông tin của bạn sẽ được bảo mật tuyệt đối</p>
    </div>
    <form action="" method="post" id="frm-comment" class="frm-comment">
        <div class="form-group">
            <select name="ranking" id="ranking" class="form-control">
                <option value="">Chọn đánh giá</option>
                <option value="5">Hài lòng tuyệt đối</option>
                <option value="4">Hơn cả mong đợi</option>
                <option value="3">Hài lòng</option>
                <option value="2">Dưới trung bình</option>
                <option value="1">Thất vọng</option>
            </select>
            <span class="frm_error error_ranking"></span>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="fullname" value="" placeholder="Họ tên của bạn" />
            <span class="frm_error error_fullname"></span>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="phone" value="" placeholder="Điện thoại của bạn" />
            <span class="frm_error error_phone"></span>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="email" value="" placeholder="Email" />
            <span class="frm_error error_email"></span>
        </div>
        <div class="form-group">
            <textarea rows="10" class="form-control" name="message" placeholder="Nội dung đánh giá"></textarea>
            <span class="frm_error error_message"></span>
        </div>
        <div class="clearfix text-center">
            <button type="submit" id="btn_submit_frm_comment" class="btn btn-main">Gửi Bình Luận</button>
        </div>
        <input type="hidden" name="idPost" value="{{ $rs['id'] }}">
        <input type="hidden" name="link" value="{{ url()->current() }}">
        @csrf
        <div class="loading_savefie" id="loading_savefie"><div class="loading_savefie_cnt"><div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div></div>
    </form>
</div>
<!--/comment-add-->
@section('custom_js')
<script>
    $(document).ready(function () {
        $("#frm-comment").validate({
			rules: {
				fullname: {
					required: true
				},
				ranking: {
					required: true
				},
				message: {
					required: true,
                    minlength: 10,
					maxlength: 5000
				},
				phone: {
					required: true,
					number: true,
					minlength: 9,
					maxlength: 11
				},
			},
			messages: {
				fullname: {
					required: 'Không được để trống'
				},
				ranking: {
					required: 'Không được để trống'
				},
				message: {
					required: 'Không được để trống',
                    minlength: 'Ít nhất 10 ký tự',
					maxlength: 'Tối đa 1.000 ký tự',
				},
				phone: {
					required: 'Không được để trống',
					number: 'Phải là số',
					minlength: 'Không đúng chuẩn',
					maxlength: 'Không đúng chuẩn',
				},
			},
			errorPlacement: function(error, element) {
				var name = element.attr("name");
				$(".error_"+name).text(error.html());
			},
			highlight: function(element) {
				$(element).addClass("is-invalid");
			},
			unhighlight: function(element) {
				$(element).removeClass("is-invalid");
			},
			success: function(element) {
				$(element).closest('div.form-group').find('.frm_error').html('');
			},
			submitHandler: function (form) {
                $("#loading_savefie").show();
                var objForm = $("#frm-comment");
                var objBtn = $("#btn_submit_frm_comment");
                objBtn.prop('disabled', true);
				$.ajax({
                    url: '{{ route("frontend.comment.add") }}',
                    type: 'POST',
                    dataType: 'json',
                    data: objForm.serialize(),
                })
                .done(function(response) {
                    if(response.status == 1){
                        objForm.trigger('reset');
                        $.confirm({
                            title: '{{ __("common._noti_header_title_success") }}',
                            content: response.msg,
                            type: 'green',
                            animation: 'zoom',
                            closeAnimation: 'scale',
                            useBootstrap: false,
                            boxWidth: '90%',
                            buttons: {
                                ok: function () {
                                    
                                }
                            }
                        });
                    }else{
                        $.confirm({
                            title: '{{ __("common._noti_header_title_error") }}',
                            content: response.list_error,
                            type: 'red',
                            animation: 'zoom',
                            closeAnimation: 'scale',
                            useBootstrap: false,
                            boxWidth: '90%',
                            buttons: {
                                ok: function () {
                                    objBtn.prop('disabled', false);
                                }
                            }
                        });
                    }
                    $("#loading_savefie").hide();
                })
                .fail(function(error) {
                    console.log("error");
                });
                return false;
			}
        });
    });
</script>
@endsection