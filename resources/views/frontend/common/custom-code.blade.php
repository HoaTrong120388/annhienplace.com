{{-- 
    Chèn script trong admin
    1: Code header
    2: Code body
    3: Code footer
--}}

@if ($type_include == 1)
    {!! $setting_result['header_script'] ?? '' !!}
@elseif($type_include == 2)    
    {!! $setting_result['body_script'] ?? '' !!}
@else
    {!! $setting_result['footer_script'] ?? '' !!}
@endif
