@props(['product'])
<div class="product-item">
    <a href="{{ route('products.show', $product->slug) }}"><img src="{{ $product->image }}" alt=""></a>
    <div class="down-content">
        <a href="{{ route('products.show', $product->slug) }}">
            <h4>{{ $product->title }}</h4>
        </a>
        <h6>${{ $product->price }}</h6>
        <p>{{ Str::limit($product->description, 50) }}</p>
        <ul class="stars">
            <li><i class="fa fa-star"></i></li>
            <li><i class="fa fa-star"></i></li>
            <li><i class="fa fa-star"></i></li>
            <li><i class="fa fa-star"></i></li>
            <li><i class="fa fa-star"></i></li>
        </ul>
        <span>Reviews (24)</span>
    </div>
</div>