@extends('frontend.layouts.layout')
@section('content')
    @include('frontend.common.header-content')
    <section class="blog blog-block">
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
                    @include('frontend.content.service.item-service', ['item' =>  $item])
                @endforeach
            </div>
        </div>
    </section>
@endsection