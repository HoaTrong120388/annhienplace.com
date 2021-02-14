@extends('frontend.layouts.layout')
@section('content')
    @include('frontend.common.header-content')
    <section class="products">
        <div class="container">
            <header class="">
                <h3 class="h3 title">{{ $header_title ?? '' }}</h3>
            </header>
            <div class="row">
                <!-- === product-items === -->
                <div class="col-md-12 col-xs-12">
                    <div class="row">
                        @foreach ($lstResult as $item)
                            @include('frontend.content.product.item-product', ['item' =>  $item])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection