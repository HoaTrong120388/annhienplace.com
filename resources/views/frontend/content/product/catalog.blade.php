@extends('frontend.layouts.layout')
@section('content')
<!-- ======================== Main header ======================== -->
<section class="main-header" style="background-image:url('public/frontend/assets/images/bg-02.jpg')">
    <header>
        <div class="container">
            <h1 class="h2 title">Shop</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Library</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data</li>
                </ol>
            </nav>
        </div>
    </header>
</section>
<!-- ======================== Products ======================== -->
<section class="products">
    <div class="container">
        <header class="">
            <h3 class="h3 title">Product category with topbar</h3>
        </header>
        <div class="row">
            <!-- === product-items === -->
            <div class="col-md-12 col-xs-12">
                <div class="row">
                    @for ($i = 0; $i < 6; $i++)
                        @include('frontend.content.list.item-product.item', ['arrResult' =>  $i])
                    @endfor
                </div><!--/row-->
                <!--Pagination-->
                <div class="pagination-wrapper">
                    <ul class="pagination">
                        <li>
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('headerstyle')
@endsection
@section('footerjs')
@endsection