@extends('backend.layout-login')
@section('content')
<div class="text-center">
	<a href="" class="logo"><span><span>Admin</span> HDradio</span></a>
</div>
<div class="m-t-40 card-box">
    <div class="text-center">
        <h4 class="text-uppercase font-bold m-b-0">Welcome Back</h4>
    </div>
    <div class="p-20">
        <form method="post" action="" role="form" class="text-center">
			<div class="user-thumb">
				<img src="{{ URL::asset('public/backend/assets/images/login.svg') }}" class="img-fluid rounded-circle img-thumbnail" alt="thumbnail">
			</div>
			<div class="form-group mb-0">
				<p class="text-muted m-t-10">
					Nhập mật khẩu để vào trang quản trị
				</p>
				<div class="input-group m-t-30 m-b-10">
					<input type="password" name="password" class="form-control" placeholder="Password" required="">
					<span class="input-group-append">
						<button type="submit" class="btn btn-pink w-sm waves-effect waves-light">
							Log In
						</button>
						{{ csrf_field() }}
					</span>
				</div>
				@if (count($errors)>0)
					<div class="card m-b-30 text-white bg-danger">
						<div class="card-body">
							<blockquote class="card-bodyquote mb-0">
								@foreach ($errors->all() as $err)
									<p class="mb-1 text-left">{!! $err !!}</p>
								@endforeach
							</blockquote>
						</div>
					</div>
				@endif
				@if (!empty($error_login))
					<div class="card m-b-30 text-white bg-danger">
						<div class="card-body">
							<blockquote class="card-bodyquote mb-0">
								<p style="margin-bottom: 0px;">{{  $error_login }}</p>
							</blockquote>
						</div>
					</div>
				@endif
			</div>
		</form>
    </div>
</div>
<!-- end card-box -->
<div class="row">
	<div class="col-sm-12 text-center">
		<p class="text-muted">Không phải {{ Session::get('user_fullname') }}<a href="{{ URL::route('admin.logout') }}" class="text-primary m-l-5"><b>Đăng nhập</b></a></p>
	</div>
</div>
@endsection