@extends('site.layouts.app')
@section('title', "Products")

@section('content')
    <!-- Page Content -->
    <div class="page-heading products-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>new arrivals</h4>
                        <h2>sixteen products</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="filters">
                        <ul>
                            <li class="active" data-filter="*">All Products</li>
                            <li data-filter=".des">Featured</li>
                            <li data-filter=".dev">Flash Deals</li>
                            <li data-filter=".gra">Last Minute</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="filters-content">
                        <div class="row grid">
                            @foreach ($products as $product)
                                <div class="col-lg-4 col-md-4 all des">
                                    <x-product-cart :product="$product" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-12 d-flex justify-content-center">

                    {{ $products->links() }}
                </div> --}}
                <div class="col-md-12">
                    <ul class="pages">
                        @if($products->currentPage() != 1)
                            <li><a href="{{ $products->previousPageUrl() }}"><i class="fa fa-angle-double-left"></i></a></li>
                        @endif
                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)

                            <li class="{{ $page == $products->currentPage() ? 'active' : '' }}"><a
                                    href="{{ $url }}">{{ $page }}</a></li>
                        @endforeach

                        @if ($products->currentPage() != $products->lastPage())
                            <li><a href="{{ $products->nextPageUrl() }}"><i class="fa fa-angle-double-right"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
