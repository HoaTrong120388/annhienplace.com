@if (isset($breadcrumb) && is_array($breadcrumb))
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}"><span class="icon icon-home"></span></a></li>
            @foreach ($breadcrumb as $brea)
                @if ($loop->last)
                    <li class="breadcrumb-item active" aria-current="page">{{ $brea['title'] ?? '' }}</li>
                @else
                    <li class="breadcrumb-item"><a href="{{ $brea['link'] ?? '' }}">{{ $brea['title'] ?? '' }}</a></li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif