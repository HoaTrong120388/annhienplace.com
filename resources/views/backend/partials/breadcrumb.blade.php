<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{ URL::route('admin.dashboard') }}">WLM Admin</a></li>
                    
                    @if (!empty($breadcrumbs))
                        @foreach ($breadcrumbs as $breadcrumb)
                            @if($loop->last)
                                <li class="breadcrumb-item active">{{ $breadcrumb['Title'] }}</li>
                            @else
                                <li class="breadcrumb-item"><a href="{{ $breadcrumb['Link']}}">{{ $breadcrumb['Title'] }}</a></li>
                            @endif
                        @endforeach
                    @endif
                </ol>
            </div>
            <h4 class="page-title">{{ $page_title }}</h4>
        </div>
    </div>
</div>