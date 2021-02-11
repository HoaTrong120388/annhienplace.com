
<section class="main-header @if (isset($type) && $type == 'blog') main-header-blog @endif" style="background-image:url('public/frontend/assets/images/bg-02.jpg')">
    <header>
        <div class="container @if (isset($type) && $type == 'blog') text-center @endif"">
            <h1 class="h2 title">{{ $header_title ?? '' }}</h1>
            @include('frontend.common.breadcrumb')
        </div>
    </header>
</section>