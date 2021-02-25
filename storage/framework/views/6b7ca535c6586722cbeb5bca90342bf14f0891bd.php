<!--footer social-->
<div class="footer-social">
    <div class="row">
        <div class="col-sm-6">
            
        </div>
        <div class="col-sm-6 links">
            <ul>
                <?php echo $__env->make('frontend.common.social-icon-page', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </ul>
        </div>
    </div>
</div>