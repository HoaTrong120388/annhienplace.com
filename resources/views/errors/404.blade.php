@extends('frontend.layouts.layout')
@section('content')
<section class="not-found">
    <div class="container">
        <h1 class="title" data-title="Page not found!">404</h1>
        <div class="h4 subtitle">Sorry! Không tìm thấy trang..</div>
        <p>Không tìm thấy URL được yêu cầu trên máy chủ này. Đó là tất cả những gì chúng tôi biết.</p>
        <p>Click <a href="{{ route("frontend.home") }}">here</a> để quay về trang chủ? </p>
    </div>
</section>
@endsection