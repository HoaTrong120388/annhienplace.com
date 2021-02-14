extends('backend.layout')
@section('headerstyle')
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <!-- meta -->
        <div class="profile-user-box card-box bg-custom">
            <div class="row">
                <div class="col-sm-6">
                    <span class="float-left mr-3"><img src="{{ $info_user->UrlHinh }}" alt="" class="thumb-lg rounded-circle"></span>
                    <div class="media-body text-white">

                        <h4 class="mt-1 mb-1 font-18">{{ $info_user->HoTen }}</h4>
                        <p class="font-13 text-light"> User Experience Specialist</p>
                        <p class="text-light mb-0">{{ $info_user->DiaChi }}</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- Signup modal content -->
                    <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form class="form-horizontal" action="#" id="frm-update-info">
                                        <div class="form-group m-b-25">
                                            <div class="col-12">
                                                <label for="username">Full Name</label>
                                                <input class="form-control" type="text" id="username" name="username" required="" placeholder="Trọng Hóa">
                                            </div>
                                        </div>
                                        <div class="form-group m-b-25">
                                            <div class="col-12">
                                                <label for="emailaddress">Email address</label>
                                                <input class="form-control" type="email" id="email" name="email" required="" placeholder="ttronghoa12388@gmail.com">
                                            </div>
                                        </div>
                                        <div class="form-group m-b-25">
                                            <div class="col-12">
                                                <label for="Phone">Phone</label>
                                                <input class="form-control" type="text" required="" id="Phone" name="phone" placeholder="0906 366 023">
                                            </div>
                                        </div>
                                        <div class="form-group m-b-25">
                                            <div class="col-12">
                                                <label for="Address">Address</label>
                                                <input class="form-control" type="text" required="" id="Address" name="address" placeholder="907/25B Lò Gốm F5 Q6">
                                            </div>
                                        </div>
                                        {{ csrf_field() }}
                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-12">
                                                <button class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="button" id="btn-update-info">Update</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <div class="text-right">
                        <button type="button" class="btn btn-light waves-effect" data-toggle="modal" data-target="#signup-modal">
                            <i class="mdi mdi-account-settings-variant mr-1"></i> Edit Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--/ meta -->
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-xl-4">
        <!-- Personal-Information -->
        <div class="card-box">
            <h4 class="header-title mt-0 m-b-20">Thông Tin Ngắn Gọn</h4>
            <div class="panel-body">
                <p class="text-muted font-13">
                    Hye, I’m Johnathan Doe residing in this beautiful world. I create websites and mobile apps with great UX and UI design. I have done work with big companies like Nokia, Google and Yahoo. Meet me or Contact me for any queries. One Extra line for filling space. Fill as many you want.
                </p>
                <hr/>
                <div class="text-left">
                    <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">{{ $info_user->HoTen }}</span></p>
                    <p class="text-muted font-13"><strong>Mobile :</strong><span class="m-l-15">{{ $info_user->DienThoai }}</span></p>
                    <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">{{ $info_user->Email }}</span></p>
                    <p class="text-muted font-13"><strong>Location :</strong> <span class="m-l-15">{{ $info_user->DiaChi }}</span></p>

                </div>
                <ul class="social-links list-inline m-t-20 m-b-0">
                    <li class="list-inline-item">
                        <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Personal-Information -->

    </div>

    <div class="col-xl-8">
        <div class="row">
            <div class="col-sm-4">
                <div class="card-box tilebox-one">
                    <i class="icon-layers float-right text-muted"></i>
                    <h6 class="text-muted text-uppercase mt-0">Bài Viết</h6>
                    <h2 class="m-b-20" data-plugin="counterup">1,587</h2>
                    <span class="badge badge-custom"> +11% </span> <span class="text-muted">From previous period</span>
                </div>
            </div><!-- end col -->

            <div class="col-sm-4">
                <div class="card-box tilebox-one">
                    <i class="icon-picture float-right text-muted"></i>
                    <h6 class="text-muted text-uppercase mt-0">Hình Ảnh</h6>
                    <h2 class="m-b-20" data-plugin="counterup">1,890</h2>
                    <span class="badge badge-custom"> +89% </span> <span class="text-muted">Last year</span>
                </div>
            </div><!-- end col -->
            <div class="col-sm-4">
                    <div class="card-box tilebox-one">
                        <i class="icon-paypal float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase mt-0">Doanh Thu</h6>
                        <h2 class="m-b-20">$<span data-plugin="counterup">46,782</span></h2>
                        <span class="badge badge-danger"> -29% </span> <span class="text-muted">From previous period</span>
                    </div>
                </div><!-- end col -->
        </div>
        <!-- end row -->

        <div class="card-box">
            <h4 class="header-title mt-0 mb-3">Kinh Nghiệm</h4>
            <div class="">
                <div class="">
                    <h5 class="text-custom m-b-5">Lead designer / Developer</h5>
                    <p class="m-b-0">websitename.com</p>
                    <p><b>2010-2015</b></p>
                    <p class="text-muted font-13 m-b-0">Lorem Ipsum is simply dummy text
                        of the printing and typesetting industry. Lorem Ipsum has
                        been the industry's standard dummy text ever since the
                        1500s, when an unknown printer took a galley of type and
                        scrambled it to make a type specimen book.
                    </p>
                </div>
                <hr>
                <div class="">
                    <h5 class="text-custom m-b-5">Senior Graphic Designer</h5>
                    <p class="m-b-0">coderthemes.com</p>
                    <p><b>2007-2009</b></p>
                    <p class="text-muted font-13">Lorem Ipsum is simply dummy text
                        of the printing and typesetting industry. Lorem Ipsum has
                        been the industry's standard dummy text ever since the
                        1500s, when an unknown printer took a galley of type and
                        scrambled it to make a type specimen book.
                    </p>
                </div>
            </div>
        </div>

    </div>
    <!-- end col -->
</div>
<!-- end row -->
@endsection


@section('footerjs')
<!-- Counter Up  -->
<script src="{{ URL::asset('backend/plugins/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ URL::asset('backend/plugins/counterup/jquery.counterup.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $("#btn-update-info").on('click', function(){
			$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			});
            var data = $("#frm-update-info").serialize();
            $.ajax({
                type: "POST",
                url: "{{ URL::route('admin.user.updateinfo') }}",
                data: data,
                dataType: "Json",
                success: function (response) {
                    console.log(response);
                },
                error: function (response) {
                    console.log(response);
                }
            });

        });
    });
</script>
@endsection