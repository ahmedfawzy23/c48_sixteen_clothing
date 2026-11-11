@extends('admin.layouts.app')
@section('content')
    <h1>Product Index</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Create new product</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Price</th>
                <th scope="col">Stock</th>
                <th scope="col">Image</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td><img src="{{ $product->image }}"></td>
                    <td>
                        <form action="{{ route('admin.products.toggle', $product->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" {{ $product->is_active ? 'checked' : ''}}
                                    id="flexSwitchCheckDefault" onchange="this.form.submit()">
                            </div>
                        </form>

                    </td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
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
    {{ $products->links() }}
@endsection
