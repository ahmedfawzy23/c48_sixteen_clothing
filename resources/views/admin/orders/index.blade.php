@extends('admin.layouts.app')
@section('content')
    <h1>Orders Index</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Total</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_phone }}</td>
                    <td>{{ $order->total }}</td>
                    <td>
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="post">
                            @csrf

                            <div class="form-check form-switch">
                                <select name="status" id="" onchange="this.form.submit()">
                                    <option {{ $order->status == "pending" ? "selected" : '' }} value="pending">Pending</option>
                                    <option {{ $order->status == "completed" ? "selected" : '' }} value="completed">completed
                                    </option>
                                    <option {{ $order->status == "cancelled" ? "selected" : '' }} value="cancelled">cancelled
                                    </option>
                                </select>
                            </div>
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
    {{ $orders->links() }}
@endsection
