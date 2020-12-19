    @if (!empty($setting_result['social_fanpage']))
    <li>
        <a href="{{ $setting_result['social_fanpage'] or '' }}">
            <i class="fab fa-facebook-square"></i>
            @if (isset($name)) Facebook @endif
        </a>
    </li>
    @endif
    @if (!empty($setting_result['social_twitter']))
    <li>
        <a href="{{ $setting_result['social_twitter'] or '' }}">
            <i class="fab fa-twitter-square"></i>
            @if (isset($name)) Twitter @endif
        </a>
    </li>
    @endif
    @if (!empty($setting_result['social_linkedin']))
    <li>
        <a href="{{ $setting_result['social_linkedin'] or '' }}">
            <i class="fab fa-linkedin-in"></i>
            @if (isset($name)) Linkedin @endif
        </a>
    </li>
    @endif
    @if (!empty($setting_result['social_instagram']))
    <li>
        <a href="{{ $setting_result['social_instagram'] or '' }}">
            <i class="fab fa-linkedin"></i>
            @if (isset($name)) Instagram @endif
        </a>
    </li>
    @endif
    @if (!empty($setting_result['social_youtube']))
    <li>
        <a href="{{ $setting_result['social_youtube'] or '' }}">
            <i class="fab fa-youtube"></i>
            @if (isset($name)) Youtube @endif
        </a>
    </li>
    @endif