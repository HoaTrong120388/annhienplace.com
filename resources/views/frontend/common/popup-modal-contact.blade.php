<div id="popup_register">
    <div id="form_register_contact">
        <h3>{{ __("common.popup_title_contact") }}</h3>
        <p>{{ __("common.popup_description_contact") }}</p>
        <form action="" id="frm_register_contact" method="post">
            <div class="frm_control">
                <input name="fullname" placeholder="{{ __("common.contact_page_form_fullname") }}" type="text">
            </div>
            <div class="frm_control">
                <input name="phone" placeholder="{{ __("common.contact_page_form_phone") }}" type="text">
            </div>
            <div class="frm_control">
                <input name="email" placeholder="{{ __("common.contact_page_form_email") }}" type="text">
            </div>
            <div class="frm_control">
                <select name="country" >
                    <option value="0">{{ __("common.select_country") }}</option>
                    @foreach ($NavStudyAbroad as $group)
                        @foreach ($group as $item)
                        <option value="{{ $item->title }}">{{ $item->title }}</option>
                        @endforeach
                    @endforeach
                </select>
            </div>
            <div class="frm_control">
                <select name="year">
                    <option value="0">{{ __("common.select_year") }}</option>
                    @for ($i = 0; $i < 5; $i++)
                        <option value="{{ now()->year + $i }}">{{ now()->year + $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="frm_control mb0">
                <button type="button" class="submit_register" id="submit_register">
                    {{ __("common.button_register_contact") }}
                </button>
                <div class="submit_send"><div class="dot-pulse"></div></div>
            </div>
            {{ csrf_field() }}
        </form>
    </div>
</div>
@section('js_popup_register')
<script>
    $(document).ready(function () {
        $("#submit_register").on('click', function(){
            var obj = $(this);
            obj.next('.submit_send').css('display', 'inline-block');
            obj.prop('disabled', true);
            console.log('xong');
            $.ajax({
                url: '{{ route('frontend.register.submit') }}',
                type: 'POST',
                dataType: 'json',
                data: $("#frm_register_contact").serialize(),
            })
            .done(function(response) {
                console.log(response);
                if(response.status == 1){
                    $("#submit_register").trigger('reset');
                    $.confirm({
                        title: '{{ __("common._noti_header_title_success") }}',
                        content: response.msg,
                        type: 'green',
                        animation: 'zoom',
                        closeAnimation: 'scale',
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
                        buttons: {
                            ok: function () {
                                obj.next('.filter-spinner-loading').hide();
                                obj.prop('disabled', false);
                                obj.next('.submit_send').css('display', 'none');
                            }
                        }
                    });
                }

                console.log("success");
            })
            .fail(function(error) {
                console.log("error");
            });

        });
        
    });
    $(document).on('click', '.register_contact', function(){
        $.fancybox.open({
            'src': '#popup_register',
            // 'modal': true,
            'closeBtn': true,
            'smallBtn' : '<div data-fancybox-close class="fancybox-close-small modal-close">Button</div>'
        });
    });
</script>
@endsection