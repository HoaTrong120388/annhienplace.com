@include('backend.layouts.header')
<!-- BEGIN: Error Page -->
<div class="error-page flex flex-col lg:flex-row items-center justify-center h-screen text-center lg:text-left">
    <div class="-intro-x lg:mr-20">
        <img alt="Midone Tailwind HTML Admin Template" class="h-48 lg:h-auto" src="dist/images/error-illustration.svg">
    </div>
    <div class="text-white mt-10 lg:mt-0">
        <div class="intro-x text-6xl font-medium">404</div>
        <div class="intro-x text-xl lg:text-3xl font-medium">Oops. Trang này hiện không tồn tại.</div>
        <div class="intro-x text-lg mt-3">Bạn có thể đã nhập sai địa chỉ hoặc trang có thể đã bị xóa.</div>
        <a href="{{ route("frontend.home") }}" class="intro-x inline-block button border border-white dark:border-dark-5 dark:text-gray-300 mt-10">Quay về trang chủ</a>
    </div>
</div>
<!-- END: Error Page -->
@include('backend.layouts.footer')