@if (!empty($setting_result['social_fanpage']))
<li @if (isset($class))class="nav-item nav-item-animated-icons d-none d-md-block" @endif>
    <a href="{{ $setting_result['social_fanpage'] or '' }}">
        <i class="fa fa-facebook"></i>
        @if (isset($name)) Facebook @endif
    </a>
</li>
@endif
@if (!empty($setting_result['social_twitter']))
<li @if(isset($class))class="nav-item nav-item-animated-icons d-none d-md-block" @endif>
    <a href="{{ $setting_result['social_twitter'] or '' }}">
        <i class="fa fa-twitter"></i>
        @if (isset($name)) Twitter @endif
    </a>
</li>
@endif
@if (!empty($setting_result['social_linkedin']))
<li @if(isset($class))class="nav-item nav-item-animated-icons d-none d-md-block" @endif>
    <a href="{{ $setting_result['social_linkedin'] or '' }}">
        <i class="fa fa-linkedin"></i>
        @if (isset($name)) Linkedin @endif
    </a>
</li>
@endif
@if (!empty($setting_result['social_instagram']))
<li @if(isset($class))class="nav-item nav-item-animated-icons d-none d-md-block" @endif>
    <a href="{{ $setting_result['social_instagram'] or '' }}">
        <i class="fa fa-instagram"></i>
        @if (isset($name)) Instagram @endif
    </a>
</li>
@endif
@if (!empty($setting_result['social_youtube']))
<li @if(isset($class))class="nav-item nav-item-animated-icons d-none d-md-block" @endif>
    <a href="{{ $setting_result['social_youtube'] or '' }}">
        <i class="fa fa-youtube"></i>
        @if (isset($name)) Youtube @endif
    </a>
</li>
@endif