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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cartItems as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item['product']->title }}</td>
                        <td>{{ $item['product']->price }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $item['product']->price * $item['quantity'] }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item['product']->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No items in cart</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <hr>
        @if(!empty($cartItems))
            <h2>Cart Total</h2>
            <p>Total : {{ $totalPrice }}</p>

            <form action="{{ route('cart.clear') }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-sm">Clear Cart</button>
            </form>

        @endif

    </div>

@endsection