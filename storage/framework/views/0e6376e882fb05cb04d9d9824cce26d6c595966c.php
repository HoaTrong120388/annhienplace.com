            <footer>
                <div class="container">
                    <!--footer showroom-->
                    <div class="footer-showroom">
                        <div class="row">
                            <div class="col-sm-8">
                                <h2>Visit our showroom</h2>
                                <p>200 12th Ave, New York, NY 10001, USA</p>
                                <p>Mon - Sat: 10 am - 6 pm &nbsp; &nbsp; | &nbsp; &nbsp; Sun: 12pm - 2 pm</p>
                            </div>
                            <div class="col-sm-4 text-center">
                                <a href="#" class="btn btn-clean"><span class="icon icon-map-marker"></span> Get directions</a>
                                <div class="call-us h4"><span class="icon icon-phone-handset"></span> 333.278.06622</div>
                            </div>
                        </div>
                    </div>
                    <!--footer social-->
                    <div class="footer-social">
                        <div class="row">
                            <div class="col-sm-6">
                                
                            </div>
                            <div class="col-sm-6 links">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div> <!--/wrapper-->

        <?php echo $__env->make('frontend.partials.footer.footer-js', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </body>
</html>