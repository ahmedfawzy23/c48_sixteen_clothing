@extends('site.layouts.app')
@section('title', $product->title)


@section('content')
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
        <div class="owl-banner owl-carousel">
            <div class="banner-item-01">
                <div class="text-content">
                    <h4>{{ $product->category->title }}</h4>
                    <h2>{{ $product->title }}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Ends Here -->


    <div class="best-features">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>{{ $product->title }}</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="left-content">
                        <h4>{{ $product->title }}</h4>
                        <p>{{ $product->description }}</p>
                        <form action="{{ route('cart.add') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" name="quantity" value="1" min="1">
                            <button type="submit" class="btn btn-danger">Add To Cart</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-image">
                        <img src="{{ $product->image }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    

@endsection
