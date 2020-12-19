<div class="popup_register_info"  id="popup_register">
    <div class="form_register_contact">
        <h3>{{ __("landingpage.popup_title_contact") }}</h3>
        <form action="" id="frm_register_contact" method="post">
            <div class="frm_control">
                <input name="fullname" placeholder="{{ __("landingpage.contact_page_form_fullname") }}" type="text">
            </div>
            <div class="frm_control">
                <input name="phone" placeholder="{{ __("landingpage.contact_page_form_phone") }}" type="text">
            </div>
            <div class="frm_control">
                <input name="email" placeholder="{{ __("landingpage.contact_page_form_email") }}" type="text">
            </div>
            <div class="frm_control">
                <textarea name="content" placeholder="{{ __("landingpage.contact_page_form_content") }}"></textarea>
            </div>
            <div class="frm_button">
                <button type="button" id="submit_register">
                    {{ __("landingpage.button_register_contact") }}
                </button>
            </div>
            {{ csrf_field() }}
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#submit_register").on('click', function(){
            var obj = $(this);
            obj.next('.submit_send').css('display', 'inline-block');
            obj.prop('disabled', true);
            $.ajax({
                url: '{{ route('frontend.landingpgae.register.submit') }}',
                type: 'POST',
                dataType: 'json',
                data: $("#frm_register_contact").serialize(),
            })
            .done(function(response) {
                if(response.status == 1){
                    $("#submit_register").trigger('reset');
                    $.confirm({
                        title: '{{ __("common._noti_header_title_success") }}',
                        content: response.msg,
                        type: 'green',
                        animation: 'zoom',
                        closeAnimation: 'scale',
                        boxWidth: '30%',
                        useBootstrap: false,
                        buttons: {
                            ok: function () {
                                location.reload();
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
                        boxWidth: '30%',
                        useBootstrap: false,
                        buttons: {
                            ok: function () {
                                obj.next('.filter-spinner-loading').hide();
                                obj.prop('disabled', false);
                                obj.next('.submit_send').css('display', 'none');
                            }
                        }
                    });
                }
            })
            .fail(function(error) {
                console.log("error");
            });

        });
        
    });
    $(document).on('click', '.register_contact', function(){
        $.fancybox.close('all');
        $.fancybox.open({
            'src': '#popup_register',
            'closeBtn': true,
        });
    });
</script>