<!--footer showroom-->
<div class="footer-showroom">
    <div class="row">
        <div class="col-sm-8">
            <h2><?php echo e($setting_result['company_name'] ?? ''); ?></h2>
            <p><?php echo e($setting_result['company_address'] ?? ''); ?></p>
            <p><?php echo $setting_result['company_work_time_footer'] ?? ''; ?></p>
        </div>
        <div class="col-sm-4 text-center">
            <a href="<?php echo e(route('frontend.contact')); ?>" class="btn btn-clean"><span class="icon icon-map-marker"></span> Chỉ đường</a>
            <div class="call-us h4"><span class="icon icon-phone-handset"></span> <?php echo e($setting_result['company_phone'] ?? ''); ?></div>
        </div>
    </div>
</div>