<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <h2>Sixteen <em>Clothing</em></h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <x-nav-link route="home" lable="Home" />
                    <x-nav-link route="products" lable="Our Products" />
                    <x-nav-link route="about" lable="About Us" />
                    <x-nav-link route="contact" lable="Contact Us" />

                </ul>
            </div>
            <form class="form-inline my-2 my-lg-0" method="get" action="{{ route('products') }}">
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search"
                    value="{{ request()->search }}" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>

        </div>
        @auth
            <form class="form-inline" method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
            </form>
        @endauth

    </nav>
</header>