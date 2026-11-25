<div>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="search-container position-relative">
                    <input class="form-control search-input ps-5" type="search" wire:model.live.debounce.300ms="search"
                        placeholder="Search anything..." aria-label="Search">

                </div>
            </div>
        </div>
    </div>

    <div wire:loading>Loading.....</div>
    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="filters-content">
                        <div class="row grid">
                            @foreach ($products as $product)
                                <div class="col-lg-4 col-md-4 all des">
                                    <div wire:key="product-{{ $product->id }}">

                                        <x-product-cart :product="$product" />
                                        {{-- @if($product->stock > 0) --}}
                                            <button wire:click="addToCart({{ $product->id }})" class="btn btn-danger mb-5">Add
                                                to cart</button>
                                        {{-- @else --}}
                                            {{-- <p class="text-danger mt-2">Out of Stock</p> --}}
                                        {{-- @endif --}}

                                        @error('product.' . $product->id)
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-flex justify-content-center">

                    {{ $products->links() }}
                </div>
                {{-- <div class="col-md-12">
                    <ul class="pages">
                        @if($products->currentPage() != 1)
                        <li><a href="{{ $products->previousPageUrl() }}"><i class="fa fa-angle-double-left"></i></a>
                        </li>
                        @endif
                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)

                        <li class="{{ $page == $products->currentPage() ? 'active' : '' }}"><a href="{{ $url }}">{{
                                $page }}</a></li>
                        @endforeach

                        @if ($products->currentPage() != $products->lastPage())
                        <li><a href="{{ $products->nextPageUrl() }}"><i class="fa fa-angle-double-right"></i></a></li>
                        @endif
                    </ul>
                </div> --}}
            </div>
        </div>
    </div>
</div>
