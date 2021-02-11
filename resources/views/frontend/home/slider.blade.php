<section class="header-content">
    <div class="owl-slider">
        @if ($home_slider->count())
            @foreach ($home_slider as $item)
            <div class="item" style="background-image:url('{{ FCommon::cover_thumbnail($item->thumbnail) }}')">
                <div class="box">
                    <div class="container">
                        <h2 class="title animated h1" data-animation="fadeInDown">{{ $item->title }}</h2>
                        <div class="animated" data-animation="fadeInUp">
                            {!! $item->summary !!}
                        </div>
                        <div class="animated" data-animation="fadeInUp">
                            <a href="{{ $item->link }}" target="_blank" class="btn btn-main" ><i class="icon icon-cart"></i> {{ __("common.button_txt_slider") }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</section>