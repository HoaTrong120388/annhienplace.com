@extends('frontend.layouts.layout')
@section('content')
    @include('frontend.common.header-content')
    <section class="blog blog-block">
        <div class="container">
            <div class="pre-header">
                <div>
                    <h3 class="h3 title">{{ $header_title ?? '' }}</h3>
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