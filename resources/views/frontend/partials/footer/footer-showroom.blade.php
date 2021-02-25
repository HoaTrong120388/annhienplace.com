<!--footer showroom-->
<div class="footer-showroom">
    <div class="row">
        <div class="col-sm-8">
            <h2>{{ $setting_result['company_name'] ?? '' }}</h2>
            <p>{{ $setting_result['company_address'] ?? '' }}</p>
            <p>{!! $setting_result['company_work_time_footer'] ?? '' !!}</p>
        </div>
        <div class="col-sm-4 text-center">
            <a href="{{ route('frontend.contact') }}" class="btn btn-clean"><span class="icon icon-map-marker"></span> Chỉ đường</a>
            <div class="call-us h4"><span class="icon icon-phone-handset"></span> {{ $setting_result['company_phone'] ?? '' }}</div>
        </div>
    </div>
</div>