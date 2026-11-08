@extends('site.layouts.app')
@section('title', "Home")


@section('content')
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
        <div class="owl-banner owl-carousel">
            <div class="banner-item-01">
                <div class="text-content">
                    <h4>Cart</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Ends Here -->
    <div class="container my-5">
        <div class="row">
            <div class="col-6 my-5">
                <h3>Shipping Information</h3>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item['product']->title }}</td>
                                <td>${{ $item['product']->price }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>${{ $item['product']->price * $item['quantity'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-6 my-5">
                <h3>Place Order</h3>
                <form action="{{ route('checkout.store') }}" method="post" class="mt-3">
                    @csrf
                    <div class="form-group">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" class="form-control" id="customer_name" placeholder="Enter name"
                            name="customer_name" value="{{ old('customer_name', auth()->user()->name) }}">
                    </div>
                    <div class="form-group">
                        <label for="customer_phone">Customer Phone</label>
                        <input type="text" class="form-control" id="customer_phone" placeholder="Enter phone"
                            name="customer_phone" value="{{ old('customer_phone') }}">
                    </div>
                    <label for="shipping_address">Shipping Address</label>
                    <textarea class="form-control" name="shipping_address" id="shipping_address" cols="30"
                        rows="5"></textarea>
                    <button type="submit" class="btn btn-primary mt-3">Place Order</button>
                </form>
            </div>
        </div>


        <hr>
        @if(!empty($cartItems))
            <h2>Cart Total</h2>
            <p>Total : ${{ $totalPrice }}</p>

        @endif

    </div>

@endsection
