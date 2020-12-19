<!--  top header  -->
<div class="container">
    <div class="col-md-12">
    <!--  top sign  -->
    <div class="top-sign">
        <ul>
            <li id="clock-topbar"></li>
            <li>
                <a href="{{ URL::route('frontend.change.language', ['lang' => $language_next[0], 'url' => $redirect_lang ]) }}">
                    <img src="{{ asset("public/all/images/flag/flag-$language_next[0].png") }}" height="12px">{{ $language_next[1] }}
                </a>
            </li>
        </ul>
    </div>
    <!--  top sicon  -->
    <div class="top-sicon">
        <ul>
            @include('frontend.common.social-icon-share')
        </ul>
    </div>
    <!--  /top sicon  -->
    <div class="top-header">
        <a class="logo" href="{{ URL::route('frontend.home') }}">
            <img src="{{ FCommon::cover_thumbnail($setting_result['header_logo']) }}" alt="header_logo" />
        </a>
        @if (isset($setting_result['banner_header_status']) && $setting_result['banner_header_status'] == 1)
        <div class="top-add-banner">
            <img src="{{ FCommon::cover_thumbnail($setting_result['banner_header']) }}" alt="ad-banner"/>
        </div>
        @endif
    </div>
    </div>
</div>
<!--  /top header  -->