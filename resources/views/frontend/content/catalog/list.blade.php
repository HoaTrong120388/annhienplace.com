@extends('frontend.layouts.layout')
@section('content')
    @include('frontend.common.header-content')
    <section class="blog @if ($type_list == 'catalog') blog-block @endif">
        <div class="container">
            <div class="pre-header">
                <div>
                    <h2 class="h3 title">
                        {{ $rs['title'] ?? '' }}
                        @if ($arrResult->parentcategory()->count())
                            <br>
                            <small class="text-capitalize">{{ $arrResult->parentcategory->title ?? '' }}</small>
                        @endif
                    </h2>
                </div>
            </div>
            <div class="row">
                @foreach ($lstResult as $item)
                    @if ($type_list == 'catalog')
                        @include('frontend.content.news.item-catalog', ['item' =>  $item])
                    @else
                        @include('frontend.content.catalog.item-catalog', ['item' =>  $item])
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endsection