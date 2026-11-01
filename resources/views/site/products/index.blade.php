@extends('site.layouts.app')
@section('title', "Products")

@push('styles')
    <style>
        .search-container {
            background-color: white;
            border-radius: 50px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 10px;
            max-width: 500px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .search-container:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .form-control.search-input {
            border: none;
            background: transparent;
            padding-left: 20px;
            font-size: 1rem;
            height: 50px;
        }

        .form-control.search-input:focus {
            box-shadow: none;
            outline: none;
        }

        .btn-search {
            background-color: #007bff;
            color: white;
            border-radius: 50px;
            padding: 10px 20px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-search:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .search-icon {
            color: #6c757d;
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
@endpush

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


    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="search-container position-relative">
                    <form class="d-flex align-items-center" method="get" action="{{ route('products') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="search-icon feather feather-search">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input class="form-control search-input ps-5" name="search" type="search"
                            value="{{ request()->search }}" placeholder="Search anything..." aria-label="Search">
                        <button class="btn btn-search ms-2" type="submit">Search</button>
                    </form>
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