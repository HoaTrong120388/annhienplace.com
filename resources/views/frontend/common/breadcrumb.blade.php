@if (isset($breadcrumb))
    <span class="header-breadcrumb">
        @foreach ($breadcrumb as $brea)
            @if ($loop->last)
                {{ $brea['title'] }}
            @else
                <a href="{{ $brea['link'] }}">{{ $brea['title'] }}</a> / 
            @endif
            
        @endforeach
    </span>
@endif