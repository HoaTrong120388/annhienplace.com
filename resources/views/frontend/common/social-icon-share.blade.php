<li class="@if(isset($class)) {{ $class }} @endif">
    <div class="fb-share-button" data-href="{{url()->current()}}" data-layout="button" data-size="small">
        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a>
    </div>
</li>
{{-- <li class="@if(isset($class)) {{ $class }} @endif">
    <a target="_blank" href="https://twitter.com/share?url={{url()->current()}}&text={{ $titlePage_Seo ?? '' }}">
        <i class="fa fa-twitter"></i>
        @if (isset($name)) Twitter @endif
    </a>
</li>
<li class="@if(isset($class)) {{ $class }} @endif">
    <a target="_blank" href="https://pinterest.com/pin/create/bookmarklet/?media={{ $imagePage_Seo ?? '' }}&url={{url()->current()}}&description={{ $titlePage_Seo ?? '' }}">
        <i class="fa fa-pinterest"></i>
        @if (isset($name)) Pinterest @endif
    </a>
</li>
<li class="@if(isset($class)) {{ $class }} @endif">
    <a target="_blank" href="https://www.linkedin.com/shareArticle?url={{url()->current()}}&title={{ $titlePage_Seo ?? '' }}">
        <i class="fa fa-linkedin"></i>
        @if (isset($name)) Linkedin @endif
    </a>
</li> --}}
<li class="@if(isset($class)) {{ $class }} @endif">
    <div class="zalo-share-button" data-href="" data-oaid="300294648877084668" data-layout="1" data-color="blue" data-customize=false></div>
</li>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0&appId=827469944022016&autoLogAppEvents=1" nonce="OuYI9WLj"></script>
<script src="https://sp.zalo.me/plugins/sdk.js"></script>