@include('backend.layouts.header')
<!-- BEGIN: Error Page -->
<div class="error-page flex flex-col lg:flex-row items-center justify-center h-screen text-center lg:text-left">
    <div class="-intro-x lg:mr-20">
        <img alt="Midone Tailwind HTML Admin Template" class="h-48 lg:h-auto" src="dist/images/error-illustration.svg">
    </div>
    <div class="text-white mt-10 lg:mt-0">
        <div class="intro-x text-6xl font-medium">500</div>
        <div class="intro-x text-xl lg:text-3xl font-medium">Oops. Hệ thông đang quá tải.</div>
        <div class="intro-x text-lg mt-3">Website đang quá tải hoặc đang nâng cấp. Ban vui lòng chờ giây lát.</div>
        <a href="{{ route("frontend.home") }}" class="intro-x inline-block button border border-white dark:border-dark-5 dark:text-gray-300 mt-10">Hoặc quay về trang chủ</a>
    </div>
</div>
<!-- END: Error Page -->
@include('backend.layouts.footer')