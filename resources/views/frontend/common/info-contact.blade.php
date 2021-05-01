<div class="detail-info-contact">
    <h3>Thông tin liên hệ</h3>
    <ul>
        <li>
            <span><i class="fa fa-map-marker"></i></span>
            <a href="">{{ $setting_result['company_address'] ?? '' }}</a>
        </li>
        <li>
            <span><i class="fa fa-phone-square"></i></span>
            <a href="tel:{{ $setting_result['company_phone'] ?? '' }}">{{ $setting_result['company_phone'] ?? '' }}</a>
        </li>
        <li>
            <span><i class="fa fa-envelope"></i></span>
            <a href="">{{ $setting_result['company_email'] ?? '' }}</a>
        </li>
    </ul>
</div>