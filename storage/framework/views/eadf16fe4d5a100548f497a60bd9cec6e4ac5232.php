

<?php if($type_include == 1): ?>
    <?php echo $setting_result['header_script_custom'] ?? ''; ?>

<?php elseif($type_include == 2): ?>    
    <?php echo $setting_result['body_script_custom'] ?? ''; ?>

<?php else: ?>
    <?php echo $setting_result['footer_script_custom'] ?? ''; ?>

<?php endif; ?>
