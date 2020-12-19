@foreach (session('flash_notification', collect())->toArray() as $message)
    <script>show_noti('{!! $message['message'] !!}', '{{ $message['level'] }}')</script>
@endforeach

{{ session()->forget('flash_notification') }}
