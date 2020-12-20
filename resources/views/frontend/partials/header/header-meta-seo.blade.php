<link href="{{ $setting_result['company_fav_icon'] ?? '' }}" rel="shortcut icon" type="image/x-icon" />
<title>{{ $titlePage_Seo or $setting_result['company_name'] }}</title>
<meta name="description" content="{{ $keywordPage_Seo }}" />
<meta name="keywords" content="{{ $descriptionPage_Seo }}">
<meta name="author" content="{{ $setting_result['company_name'] ?? '' }}">

@if (isset($imagePage_Seo) && !empty($imagePage_Seo))
<meta property="og:image" content="@if (isset($arrResult['banner_form_register'])) {{ FCommon::cover_thumbnail($arrResult['banner_form_register']) }}@endif"/>
<meta content=1200 property=og:image:width>
<meta content=630 property=og:image:height>
@endif

<meta property="article:publisher" content="{{ $setting_result['social_fanpage'] ?? '' }}" />
<meta property="article:author" content="{{ $setting_result['social_fanpage'] ?? '' }}"/>
<meta property="og:site_name" content="{{ $descriptionPage_Seo }}" />
<meta property="og:title" content="{{ $titlePage_Seo }}" />
<meta property="og:description" content="{{ $keywordPage_Seo }}" />
<meta property="og:updated_time" content="2019-10-01" />
<meta property="og:type" content="article" />
<meta property="og:og:locale" content="vi_vn" />