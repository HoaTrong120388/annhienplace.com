@php
    if($is_mobile == 1){
        $link_banner = isset($setting_result['header_banner_mobile'])?$setting_result['header_banner_mobile']:'';
        if (isset($rs['more_info']->header_banner_mobile) && !empty($rs['more_info']->header_banner_mobile)) {
            $link_banner = $rs['more_info']->header_banner_mobile;
        }
    }else{
        $link_banner = isset($setting_result['header_banner_pc'])?$setting_result['header_banner_pc']:'';
        if (isset($rs['more_info']->header_banner_pc) && !empty($rs['more_info']->header_banner_pc)) {
            $link_banner = $rs['more_info']->header_banner_pc;
        }
    }
@endphp
<section class="main-header @if (isset($type) && $type == 'blog') main-header-blog @endif" style="background-image:url('{{ FCommon::cover_thumbnail($link_banner) }}')">
    <header>
        <div class="container @if (isset($type) && $type == 'blog') text-center @endif">
            <h1 class="h2 title">{{ $header_title ?? '' }}</h1>
            @include('frontend.common.breadcrumb')
        </div>
    </header>
</section>