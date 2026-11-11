@extends('admin.layouts.app')
@section('content')
    <h1>Product Create</h1>
    <form action="{{ route('admin.products.update', $product->id) }}" method="post" class="mt-3"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Category</label>
            <select name="category_id" id="">
                @foreach ($categories as $category)
                    <option {{ $category->id == $product->category_id ? "selected" : "" }} value="{{ $category->id }}">
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="title">title</label>
            <input type="text" class="form-control" id="title" placeholder="Enter name" name="title"
                value="{{ old('title', $product->title) }}">
        </div>
        <label for="description">description</label>
        <textarea class="form-control" name="description" id="description" cols="30"
            rows="5">{{ old('description', $product->description) }}</textarea>
        <div class="form-group mt-3">
            <label for="stock">Price</label>
            <input type="number" class="form-control" id="price" placeholder="Enter price" name="price"
                value="{{ old('price', $product->price) }}">
        </div>
        <div class="form-group">
            <label for="stock">stock</label>
            <input type="number" class="form-control" id="stock" placeholder="Enter stock" name="stock"
                value="{{ old('stock', $product->stock) }}">
        </div>
        <div class="form-group">
            <label for="image">image</label>
            <input type="file" class="form-control" id="image" placeholder="Enter image" name="image">
        </div>
        <img src="{{ $product->image }}">
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
@endsection
