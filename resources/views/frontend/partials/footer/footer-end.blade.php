<!-- copy-right -->
<div class="copy-right">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="copy-right-text">
                    {{ $setting_result['footer_copyright'] }}
                </div>
                <div class="copy-right-menu">
                <ul>
                    <li><a href="{{ route("frontend.$language.scholarship") }}">{{ __('common.nav_scholarship') }}</a></li>
                    <li><a href="{{ route("frontend.$language.studentcorner") }}">{{ __('common.nav_student_corner') }}</a></li>
                    <li><a href="{{ route("frontend.$language.contact") }}">{{ __('common.nav_contact') }}</a></li>
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- copy-right end -->